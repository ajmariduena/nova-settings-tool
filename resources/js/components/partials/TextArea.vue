<template>
    <div class="flex border-b border-40">

        <setting-label>{{ name }}</setting-label>

        <div class="w-1/2 py-6 px-8">

            <textarea
                :value="setting.value"
                @input="input"
                rows="5"
                class="w-full form-control form-input form-input-bordered py-3 h-auto"
            />

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
        link: Object
    },

    components: {
        SettingLabel,
        SettingInfo
    },

    methods: {
        input(e) {
            this.$emit('input', {
                key: this.setting.key,
                value: e.target.value
            })
        }
    }
}
</script>
