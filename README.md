# PHP-MD Blog static site generator

A simple PHP-based static site generator that uses Markdown files as data source.

## Build your website

Generate the posts, the index page, and the archive page:

```php
php generate.php --env=dev --force=1
```

For production, use a value other that "dev" for the `env` argument.

The `--force` option is optional.

Without the **force** option, the builder will only generate the html for the markdown files modified since the last 
build time (and for the new files too).

The **force** option is useful when you want to re-generate all post html files (after a template change, for example).

_Note: Unfortunately, the generation of only modified posts won't work on Netlify. Your commit trigger (webhook from
GitHub) the deployment, the buildbot will checkout your target branch, your files are copied into the container
(which will be destroyed after the build process ends), so the file modification time will change. Moreover, it won't
update the "buildtime.txt" file with the latest build time. Nevertheless, it works locally._


## Config

The global settings are defined in `config\config.php`. Update BASE_URL to your url!
The localization settings are in `config\localizations.php` for each language.
The translation strings in an associative arrays are set in `config\translations.php` for each language.
Make sure that the ErrorDocument path for the 404 page is valid in the `.htaccess` file!

## Data / Template structure

- The `\posts` folder contains all the blogposts in markdown files.
- The `\templates\views` contains the templates used for the pages.
- The `\templates\partials` folder contains specific parts of the website (header, footer, introduction, post header,
  breadcrumb, and meta).

## Engine folder

The site generator main class (`PHP_MD`) is extendable via the `PHP_MD_Trait` trait (see the **extension** folder).
Add the methods there to generate additional pages (like "contact us", or "about us" pages).
The **extension** folder won't be touched in any future releases.

## Update engine version

Download the newest release in a zip file, extract it, overwrite the content of your project's engine folder.
The `generate.php`, configuration files, the templates, and the styles won't be updated 99.9% of the time (_starting 
from version number 1.2.1_).

If there is a small change in any of the files outside the **engine** folder, there will be instructions which line 
you should update. I am not planning to break the site builder with unnecessary rewrites, it is going to be version "1.x.x" forever.

## Publishing a website to Netlify

You can also put it on shared hosting, but the Netlify deployment is presented here only.

[Register to Netlify](https://www.netlify.com/)

The `netlify.toml` configuration file contains important properties:

```raw
[build]
  base    = "/"
  publish = "public"
  command = "php generate.php --env=prod"
```

It tells Netlify the base path, the publish folder, and the command to run when building the website into the "public"
folder.


### netlify/build

Netlify builds website with its buildbot. It starts a Docker container running
the [Netlify build image](https://hub.docker.com/r/netlify/build/#!)

Netlify installs a lot of packages to be able to run the various tools to build a static
website. And this is done inside a [Docker container](https://docs.docker.com/get-started/).

When the Docker fires up, a script like this runs:*
https://github.com/netlify/build-image/blob/focal/run-build.sh

This was the Dockerfile from which the Netlify image is built (currently based on `ubuntu:20.04`, older Ubuntu base
images, like 16.04, are deprecated now):*
https://github.com/netlify/build-image/blob/focal/Dockerfile

_*Note that Netlify archived the public GitHub repo at Jan 25, 2023, and moved its build image to a private repository,
unfortunately.
So the above links does not show the up-to-date build image they use._

### CI/CD pipeline - processing stages

Netlify uses a CI/CD pipeline to perform numerous steps during the deployment stages (initializing, building, deploying,
cleanup, post-processing).

For example at the post-processing stage, it is processing the header rules (defined in the `_headers` file) and
redirection rules (defined in `_redirects` file).

## Website configuration

In the `_headers` file you can specify the HTTP headers and set Content Security Policy (CSP) rules for the
Netlify server. You can also specify these in `netlify.toml`.

The `_redirects` file is currently empty. When you have a custom domain, you can make a redirect from _.netlify.com_ to
your custom domain there.

The `robots.txt` blocks indexing the /admin url.

## Netlify Forms

Netlify automatically discovers the contact form via a custom "netlify" attribute added to the form. A bot field is
present
in the form to protect against spam bots.

[Netlify Forms Docs](https://docs.netlify.com/forms/setup/)

## Decap CMS support

The `\public\admin` folder contains all configuration, files for the integration.

Steps to get started:

1. Enable Netlify Identity
2. Enable Git Gateway
3. Set registration to "invite only", and invite yourself
4. Add "/admin" segment to the verification link you receive in the invitation email
5. Add your password

[Decap CMS documentation](https://decapcms.org/docs/choosing-a-backend/#setup-on-netlify)

## Security

All the configuration (security headers, and content security policy - CSP) is here: `\public\_headers`.
Replace `phpmd.netlify.app` to your domain at the CSP settings where present.

CSP whitelist added for:

- Netlify,
- Decap CMS,
- Algolia,
- Cloudfront,
- Google Fonts,
- jsDelivr

## Build CSS and JavaScript bundles

All styles (in SASS) and scripts are located in the `_dev` folder.
The `custom.sass` is for extensibility (future releases will only affect the files in the **parts** folder).

Generate bundles:

```
npm run webpack
```

Generate bundles with watching the file changes:

```
npm run webpack-watch
```


## License

MIT © András Gulácsi 2024-2026 - MIT license
