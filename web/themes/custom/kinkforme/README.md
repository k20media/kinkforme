## CONTENTS OF THIS FILE

- Introduction
- Installation
- Configuration
- Build Tools
- Maintainers

## INTRODUCTION

kinkforme is a Bootstrap based theme made for Drupal Commerce 2.x.

The kinkforme Drupal Theme is a highly versatile and customizable Drupal theme that is built around Commerce Kickstart and Layout Builder. It incorporates fully customized Bootstrap 5 and Bootstrap Icons, providing a wide range of theming best practice examples. With the kinkforme theme, you have extensive configuration options to adjust layouts, change fonts, handle status messages, manage icons, add classes, and utilize predefined product teaser designs. To streamline front-end tooling, the theme integrates Laravel Mix, an API on top of Webpack. Additionally, it leverages PostCSS Autoprefixer and SVG inline icons to enhance development efficiency.

* For a full description of the theme, visit the project page: https://www.drupal.org/project/kinkforme

* To submit bug reports and feature suggestions, or track changes: https://www.drupal.org/project/issues/kinkforme

## INSTALLATION

- Install as you would normally install a contributed Drupal theme. Visit https://www.drupal.org/node/1897420 for further information.

## CONFIGURATION

The kinkforme theme offers various configuration options to customize its appearance. To access the theme settings:

1. Log in to your Drupal administration panel.
2. Go to Appearance in the admin menu.
3. Find the kinkforme theme and click on the Settings link.

### Customization Options

#### Font Settings

You can easily change the font used throughout your site with the kinkforme theme. Follow these steps to adjust the font:

1. Go to Appearance and click on the Settings link for the kinkforme theme.
2. Look for the Font Settings section.
3. Choose the desired font from the available options.

#### Region/Layout Adjustments

The kinkforme theme provides flexibility in adjusting the layout of your site. To make layout adjustments:

1. Go to Appearance and click on the Settings link for the kinkforme theme.
2. Locate the Regions section.
3. Use the options provided to modify the layout, including extened configuration for the offcanvas navigation region.

- Change the direction of the offcanvas navigation.
- Control the visibility of the logo within the offcanvas navigation.
- Configure body scrolling behavior when the offcanvas menu is open.
- Choose backdrop options for the offcanvas navigation.

#### Message Styling

Customize the messages displayed to users with the kinkforme theme. To style the messages:

1. Go to Appearance and click on the Settings link for the kinkforme theme.
2. Find the Message Styling section.
3. Customize the message styles according to your preference.

### SVG Integration

The theme offers advanced support for scalable vector graphics (SVG), allowing you to utilize SVG seamlessly within your site.

## BUILD TOOLS

The kinkforme Drupal Theme leverages modern build tools to streamline frontend development, ensuring a smooth and efficient customization process. These tools enhance asset compilation, provide powerful features, and optimize your workflow. Below are the key build tools integrated into the theme:

### PostCSS Autoprefixer

Autoprefixer is a PostCSS plugin that automatically adds vendor prefixes to CSS properties.

### SVG Inline Icons

The theme also includes PostCSS Inline SVG plugin, which allows you to reference an SVG file and control its attributes using CSS syntax. You can inline an SVG file in CSS and manage its colors without modifying the original file.

To reference an SVG in SCSS, use the following syntax:

``` SCSS
background: svg-load("PATH_TO_IMAGE", fill=#{$COLOR_VARIABLE});
```

Note that the svg-load() function only overrides attributes in the `<svg>` element, and its children inherit that color. If there is already a color applied to the children, it will not be overridden.

By leveraging these build tools, the kinkforme Drupal Theme optimizes your frontend development workflow, ensuring compatibility and efficiency throughout the theme customization process.

### Installation:

Download the Node.js installation binary from [the official website](https://nodejs.org/dist/) based on your operating system. After installation, confirm Node.js and npm are available with the following commands:

```bash
node -v
npm -v
```

To install all dependecies run:

```
npm install
```

### Build Tools Usage

``` NODE
# Compiling in a Local Environment
npm run development

# Watch Assets for Changes and compile.
npm run watch

# Compiling in a Production Environment
npm run production

# Create an SVG sprite from all SVGs in the `icons` folder.
npm run icons-sprite
```

## MAINTAINERS

Current maintainers:

- Ivan Buišić (majmunbog) - https://www.drupal.org/u/majmunbog
