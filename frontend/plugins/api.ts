import { Plugin } from '@nuxt/types'
import { Api } from '../services/api';

declare module '@nuxt/types'{
    interface Context{
        $api: Api;
    }
}

declare module 'vue/types/vue'{
    interface Vue{
        $api: Api;
    }
}

const ApiPlugin: Plugin = (context, inject) => {
    const api = new Api(context.$axios);
    context.$api = api;
    inject('api', api);
}

export default ApiPlugin;
  