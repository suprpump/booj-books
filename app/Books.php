<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

///**
// * App\Books
// *
// * @property int $id
// * @property int $user_id
// * @property string $title
// * @property string $author
// * @property string $publication-date
// * @property string $image-upload
// * @property \Carbon\Carbon|null $created_at
// * @property \Carbon\Carbon|null $updated_at
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereAuthor($value)
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereCreatedAt($value)
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereId($value)
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereImageUpload($value)
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books wherePublicationDate($value)
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereTitle($value)
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereUpdatedAt($value)
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereUserId($value)
// * @mixin \Eloquent
// * @property string $publication
// * @property string $image
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereImage($value)
// * @method static \Illuminate\Database\Eloquent\Builder|\App\Books wherePublication($value)
// */
/**
 * App\Books
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $author
 * @property string $publication
 * @property string $image
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Books wherePublication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Books whereUserId($value)
 * @mixin \Eloquent

 */
class Books extends Model
{
    protected $fillable = ['user_id', 'title', 'author', 'publication', 'image'];
}
