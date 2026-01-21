# WPS Visitor Counter Translation Files

This directory contains the translation files for the WPS Visitor Counter plugin.

## Files

- `wps-visitor-counter.pot` - Portable Object Template (POT) file containing all translatable strings
- `wps-visitor-counter-es_ES.po` - Spanish (Spain) translation file
- `wps-visitor-counter-es_ES.mo` - Compiled Spanish translation file (machine-readable)

## How to Create a New Translation

1. Copy the `wps-visitor-counter.pot` file to your language code (e.g., `wps-visitor-counter-fr_FR.po` for French)
2. Open the .po file in a translation editor like Poedit
3. Translate the strings in the `msgstr` fields
4. Save the file
5. Compile it to .mo format using: `msgfmt your-file.po -o your-file.mo`

## Loading Translations

WordPress automatically loads the appropriate .mo file based on the site's language setting. The plugin uses the text domain `wps-visitor-counter`.

## Translation Statistics

- **Total strings**: 53
- **Spanish (es_ES)**: 100% translated
- **Available languages**: Spanish (es_ES)

## Contributing

To contribute a new translation:

1. Create a .po file for your language
2. Translate all strings
3. Test the translation in a WordPress installation
4. Submit a pull request with the .po file

The .mo file will be generated automatically during the build process.