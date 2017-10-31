<?php

namespace App\Http\Requests;

use App\Books;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Illuminate\Support\Facades\File;


class BookRequestForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'author' => 'required',
            'publication-date' => 'required|date',
            'image-upload' => 'required|image|mimes:jpg,png,jpeg,gif',
            //
        ];
    }

    public function persist()
    {
        $title = $this->formatString(request('title'));
        $author = $this->formatString(request('author'));
        $time_stamp = $this->formatDate(request('publication-date'));
        $file = request()->file('image-upload');
        $file_name = $this->manageImageFile($file);

        Books::create([
            'user_id' => $this->user()->id,
            'title' => $title,
            'author' => $author,
            'publication' => $time_stamp,
            'image' => $file_name,
        ]);
    }

    /**
     * @param $date
     * @return int
     */
    public function formatDate($date)
    {
        $date = trim($date);
        $parts = explode('/', $date);
        return sprintf('%s/%s/%s', $parts[2], $parts[0], $parts[1]);
    }

    /**
     * @param $data
     * @return null|string
     */
    protected function formatString($data)
    {
        $parts = explode(' ', Str::lower(trim($data)));
        $ret = null;
        if(isset($parts) && count($parts) >= 1)
        {
            foreach ($parts as $part)
            {
                if(Str::contains($part, '.'))
                {
                    $ret = sprintf('%s %s', $ret, Str::upper($part));
                    continue;
                }
                $ret = sprintf('%s %s', $ret, Str::title($part));
            }
        }
        return $ret;
    }

    /**
     * @param $file
     * @return null|string
     */
    public function manageImageFile($file)
    {
        // save the public path
        $path = $file->store('public/images', [
            'visibility' => 'public'
        ]);

        // parse out the name to save to db
        $name = null;
        preg_match('/public\\/([\\w\\d\\W]+?)\\./', $path, $matches);
        if(isset($matches) && count($matches) >= 1)
            $name = sprintf("/%s.%s", $matches[1], $file->guessExtension());

        // resize the image
        $file = storage_path(sprintf('app/%s', $path));
        $image = File::get($file);
        $this->resizeImage($image, $file);

        return $name;
    }

    public function resizeImage($data, $path)
    {
        // Create an image manager instance with favored driver
        $manager = new ImageManager(array('driver' => 'imagick'));

        // Resize image and save it
        $manager->make($data)->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);
    }
}
