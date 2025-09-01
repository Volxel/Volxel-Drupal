# Volxel Drupal Module

This is the Drupal specific implementation of the [Volxel 3D Dicom Data Viewer](https://github.com/Volxel/Volxel).

## How to use

1. Install module as you would other Drupal modules hosted via Git
2. Enable it in Drupal
3. Add a new File field to your Content Type
4. Select the `Volxel Formatter` in the display settings for the field.

The viewer expects either a bunch of small files (all the .DCM files) or one singular file, which should be a ZIP
containing all of them.

> [!NOTE]
> If you download this repository as a zip file, your browser may warn you about dangerous contents.
>
> From what I can tell, this is because [the JavaScript bundle](./assets/js/index.mjs) contains the web assembly based
> web worker I use to parse the DICOM data as inline base64 for simplicity.
>
> All code that will end up in the JavaScript bundle is open source and can be
> found [in the main repository](https://github.com/Volxel/Volxel).

## Developing this module

As noted above, this repository contains the built JavaScript bundle. To achieve this, there is a GitHub action set up
on this repository that gets triggered when there are changes to the `main` branch on the main repository. Said action
builds the new JavaScript bundle and commits it into this repository automatically.
