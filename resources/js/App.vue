<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
  watch: {
    '$route' (to) {
      document.title = to.meta.title || 'Computer Based Test'
    }
  },
}
</script>

<style>
  html {
    overflow-y: auto;
  }
  .w-100 {
    width: 100%;
  }
</style>