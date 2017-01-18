# Laravel PHP Framework

## Install

1. `cp .env.example .env` and Modify Database section and Google Authenticate section.

2. Run commands  `chmod +x first_time_setup.sh && sh first_time_setup.sh`

## Usage Notes

Data share across views should be located in `app\Providers\AppServiceProvider.php`.

`config/site.php` is the main config for modules.

`app/Site.php` is main place for call static function across project.

Application already have sample with `categories` and `modules` components.

To create a new type of content, we must follow the step as below

1. Define by adding new element to `content` part in `config/site.php` 

```
 'categories' => [
            'name' => 'Chuyên mục',
            'modules' => [
                'hot' => 'Chuyên mục hot'
            ]
        ],
```

2. Create `Model` and `Migration` script for content.

For example `php artisan make:migration create_table_categories --create=categories`
```
Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');

            //general
            $table->string('title', 255);
            $table->string('seo_title', 255)->nullable();
            $table->string('slug', 200)->unique();
            $table->text('desc')->nullable();
            $table->text('keywords')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('views')->default(0);

            //special
            $table->integer('parent_id')->default(0)->index();
            $table->timestamps();
        });
```

and `php artisan make:model Category` 

```
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    protected $fillable = [
        //general

        'title',
        'seo_title',
        'slug',
        'desc',
        'keywords',
        'content',
        'image',
        'status',
        'views',

        //special
        'parent_id'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');

    }
```

3. Next step we create `Controller` and Admin Views for this Content

For example `app\Http\Controllers\CategoriesController.php` and `resources\views\admin\categories`

4. Update `config\permissions.php` so this can access with your user.

5. Create new administrator with command

```
php artisan  add:admin --email=test@example.com --role=admin
```