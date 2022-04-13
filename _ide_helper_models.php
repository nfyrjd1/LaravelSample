<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BlogCategory
 *
 */
	class BlogCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BlogPost
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BlogPost onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BlogPost withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BlogPost withoutTrashed()
 */
	class BlogPost extends \Eloquent {}
}

