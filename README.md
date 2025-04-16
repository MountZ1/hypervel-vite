<<<<<<< Updated upstream

# Hypervel-Vite

# **This package only been tested with tailwind and plain js.**

Installation

1. Install the package via Composer

```bash
composer require mountz/hypervel-vite
```

2. Install required NPM packages

```bash
npm install @tailwindcss/vite laravel-vite-plugin tailwindcss vite
```

Configuration

1. Create vite.config.js
   Create a vite.config.js file in your project root:

```javascript
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true,
    }),
    tailwindcss(),
  ],
  server: {
    hmr: {
      host: "localhost",
    },
    cors: true,
  },
});
```

2. Update package.json
   Add the following to your package.json file:

```
json{
  "private": true,
  "type": "module",
  "scripts": {
    "build": "vite build",
    "dev": "vite"
  },
}
```

5. Update 'resources/css/app.css'

```css
@import "tailwindcss";
@source "../views";
```

6. update 'resources/js/app.js'

```javascript
import "../css/app.css";
```

7. Create JS file
   Add Vite Directive to Blade Templates
   Add the Vite directive to your Blade layout/template file:
   blade

```html
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Your App</title>
    @vite([])
  </head>
  <body>
    <!-- Your content here -->
  </body>
</html>
```

Directive Usage Notes

The @vite([]) directive with empty array will automatically include all assets in resources/js and resources/css.
You can selectively include specific assets by passing them as arguments:

```blade
@vite(["resources/js/coba.js", "resources/js/cobacoba.js"])
```

This is useful when you want to load specific scripts on certain pages only, rather than loading all scripts on every page.

Development
Run the Vite development server:
`npm run dev`
Production
Build for production:
`npm run build`
License
The MIT License (MIT). Please see License File for more information
=======

This package had been tested just for tailwind.[^1]

> > > > > > > Stashed changes
