<template>
    <div class="flex border-b border-40">
        <setting-label>{{ name }}</setting-label>
        <div class="w-1/2 py-6 px-8 flex items-center">
            <date-time-picker
                class="w-full form-control form-input form-input-bordered"
                :name="setting.name"
                :value="setting.value"
                dateFormat="Y-m-d"
                :placeholder="placeholder"
                :enable-time="false"
                :enable-seconds="false"
                :first-day-of-week="firstDayOfWeek"
                :class="errorClasses"
                @change="input"
            />
            <setting-info v-if="description || link.text" :text="link.text || ''" :url="link.url || ''" class="pt-3">{{ description }}</setting-info>
        </div>
    </div>
</template>

<script>
import SettingInfo from './Info'
import SettingLabel from './Label'
import DateTimePicker from './DateTimePicker'

export default {
    props: {
        name: String,
        setting: Object,
        description: String,
        link: Object
    },
    
    components: { DateTimePicker, SettingLabel, SettingInfo },

    methods: {
        input(e) {
            this.$emit('input', {
                key: this.setting.key,
                value: e
            })
        }
    },

    computed: {
        firstDayOfWeek() {
            return 0
        },

        placeholder() {
            return moment().format('YYYY-MM-DD')
        },
    },
}
</script>
