import Vue from 'vue';

export const EventBus = new Vue();
var api_url = '';
var gaode_maps_js_api_key = '7bad7288d0f3536e86a198fba66d560c';
switch (process.env.NODE_ENV) {
    case 'development':
        api_url = 'http://roast.test/api/v1';
        break;
    case 'production':
        api_url = 'http://roast.xxx.com/api/v1';
        break;
}
export const ROAST_CONFIG = {
    API_URL: api_url,
    GAODE_MAPS_JS_API_KEY: gaode_maps_js_api_key
}
