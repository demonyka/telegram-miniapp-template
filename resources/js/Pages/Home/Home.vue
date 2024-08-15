<script>
export default {
    name: "Home"
}
</script>

<template>
    Привет, {{ $page.props.auth.user.firstname || $page.props.auth.user.username || 'друг' }}!
</template>

<style scoped>

</style>
