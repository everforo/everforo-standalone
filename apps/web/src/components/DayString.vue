<template>
    <span class="time-string"
    :class="[{'mobile': isMobile}]">{{timeString}}</span>
</template>
<script lang="ts">
    import {Component, Prop, Vue} from 'vue-property-decorator';
    import {IS_MOBILE} from '@/helpers/Utils';

    @Component
    export default class DayString extends Vue {
        @Prop()
        public time!: string;

        @Prop()
        public online!:boolean;

        protected timeString: string = '';

        protected isMobile: boolean = IS_MOBILE;

        protected created() {
            
            // safari compatibility issue, invlid date
            // https://stackoverflow.com/questions/4310953/invalid-date-in-safari
            const timeFormated = this.time.replace(/ /,"T") + 'Z';
            const timestamp = Date.parse(timeFormated) / 1000;

            let now = Date.now() / 1000;
            // offset timezone
            // now = now + new Date().getTimezoneOffset() * 60;

            const diff = Math.ceil((now - timestamp));
            if (this.online) {
                if (diff < 60) {
                    this.timeString = this.$t('just_now') as string;
                } else if (diff < 3600) {
                    const minutes = Math.floor(diff / 60);
                    this.timeString = this.$tc('minute_ago', minutes, {n: minutes});
                } else if (diff < 86400) {
                    const hours = Math.floor(diff / 3600);
                    this.timeString = this.$tc('hour_ago', hours, {n: hours});
                } else if (diff < 2592000) {
                    const days = Math.floor(diff / 86400);
                    this.timeString = this.$tc('day_ago', days, {n: days});
                } else {
                    const months = 1;
                    this.timeString = this.$tc('month_ago', months, {n: months});
                }
            } else {
                if (diff < 60) {
                    this.timeString = this.$t('just_now') as string;
                } else if (diff < 3600) {
                    const minutes = Math.floor(diff / 60);
                    this.timeString = this.$tc('minute_ago', minutes, {n: minutes});
                } else if (diff < 86400) {
                    const hours = Math.floor(diff / 3600);
                    this.timeString = this.$tc('hour_ago', hours, {n: hours});
                } else {
                    const days = Math.floor(diff / 86400);
                    this.timeString = this.$tc('day_ago', days, {n: days});
                }
            }

        }
    }
</script>
<style lang="scss" scoped>

    .time-string {
        @include info_font;

        &.mobile {
            @include mobile_thread_time_font;
        }
    }
</style>