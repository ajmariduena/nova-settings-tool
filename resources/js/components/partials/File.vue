<template>
    <div class="flex border-b border-40">

        <setting-label>{{ name }}</setting-label>

        <div class="w-1/2 py-6 px-8">

            <a tabindex="0" v-if="value && typeof value === 'string'" :href="setting.value" target="_blank" class="cursor-pointer dim btn btn-link text-primary inline-flex items-center mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" aria-labelledby="download" role="presentation" class="fill-current mr-2">
                    <path d="M17.56 17.66a8 8 0 0 1-11.32 0L1.3 12.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95zM11.9 17a5 5 0 1 0 0-10 5 5 0 0 0 0 10z"/><circle cx="12" cy="12" r="3"/>
                </svg> 
                <span class="class">{{ __('View File') }}</span>
            </a>

            <input 
                type="file"
                @input="input"
                :accept="accept"
                class="form-file-input"
                :id="setting.key"
            />
            <label :for="setting.key" class="form-file-btn btn btn-default btn-primary">
                {{ __('Choose File') }}
            </label>

            <setting-info v-if="description || link.text" :text="link.text || ''" :url="link.url || ''" class="pt-3">{{ description }}</setting-info>

        </div>

    </div>
</template>

<script>
import SettingLabel from './Label'
import SettingInfo from './Info'

export default {
    props: {
        name: String,
        setting: Object,
        description: String,
        accept: String,
        link: Object
    },

    components: {
        SettingLabel,
        SettingInfo
    },

    methods: {
        input(e) {
            let path = event.target.value
            this.$emit('input', {
                key: this.setting.key,
                value: e.target.files[0]
            })
        }
    },

    computed: {
        value() {
            return this.setting.value;
        }
    }
}
</script>
