## UpDown

UpDown feature on any model. Easily.

### Composer installation
```terminal
composer require sunlab/wn-updown-plugin
```

### Requirements

This plugin requires the [Winter.User](https://github.com/wintercms/wn-user-plugin) Plugin.

### Usage guide - Example with Winter.Blog `Post` model
#### 1. First step, extend the model
To use the up/down feature on a model,
you need to add the `Votable` behavior to the model(s) you want:
```php
class Plugin extends PluginBase
{
    public function boot()
    {
        \Winter\Blog\Models\Post::extend(static function ($post) {
            $post->implement[] = \SunLab\UpDown\Behaviors\Votable::class;
        });
    }
}
```

#### 2. Second step, add the component to the page
Then, you need to add the `upDown` component on a blog post page or blog post list page:
```ini
title = "Blog"
url = "/blog/:page?"
layout = "default"
description = "The main blog page, with all posts."
hidden = "0"

[blogPosts]
pageNumber = "{{ :page }}"
postsPerPage = "10"
noPostsMessage = "No posts found"
sortOrder = "published_at desc"
categoryPage = "blog/category"
postPage = "blog/post"

[upDown]
==
{% component 'blogPosts' %}
```

#### 3. Third step, add the same component multiple times
Then, inside the override of the `blogPosts` partial,
add the `upDown` component **inside the loop** and
use [component's dynamic properties](https://wintercms.com/docs/cms/components#component-variables)
to initialize the component with the current post:
```twig
{# Loop over the blog posts #}
{% for post in posts %}

    {# For each post, displays the upDown component #}
    {% component 'upDown' votable=post %}

    {% partial "blog/post" post=post %}

{% endfor %}
```
