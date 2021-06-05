# capiq-webapp

## Build Setup

```bash
# install dependencies
$ yarn install

# serve with hot reload at localhost:3000
$ yarn dev

# build for production and launch server
$ yarn build
$ yarn start

# generate static project (Use this to deploy to shared hosting without Node.js support)
$ yarn generate
```

## To make changes

All texts displayed to the website's vistor are hard-coded in .vue files, to change thus texts edit the following files `pages/*.vue` and `components/*.vue`

## Facebook Share button (in the footer)

To change it:
- Visit https://developers.facebook.com/docs/plugins/share-button/?locale=fr_FR
- Enter the url to share
- Click "Get code"
- Select "iFrame"
- Copy and past code in `components/CommonContent.vue` line `19` (replace the current iFrame html markup)