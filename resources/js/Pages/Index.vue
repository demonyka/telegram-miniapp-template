<script>
export default {
    name: "Index",
    mounted() {
        const tg = window.Telegram.WebApp;
        const initParams = tg.initData;

        if (tg.platform === 'weba') {
            console.error('Web is not supported');
        } else if (!initParams) {
            console.error('Missing initData');
        } else {
            console.log(initParams);
            tg.expand();
            this.$inertia.get(route('telegram.store'), {
                initParams: initParams
            });
        }
    }
}
</script>

<template>

</template>

<style scoped>

</style>
