<template>
    <div style="background: rgba(246,246,246,1);"  >
        <herder></herder>
        <!--右侧栏目-->
        <div class="col-md-5 col-md-offset-2">
            <router-view></router-view> <!-- 路由引入的组件将在这里被渲染 -->
        </div>
        <right class="col-md-3" style="background: rgba(246,246,246,1);"></right>
    </div>
</template>

<script>
    import Herder from './Herder/Herder'
    import Right from './Right/Right'
    export default {
        components: {
            Herder,
            Right
        },
        data() {
            return {
                msg: 'Vue'
            }
        }
    }
</script>

<style>
</style>