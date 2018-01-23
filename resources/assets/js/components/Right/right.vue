<template>
    <div>
        <div>
            <div class="row" style="padding-top: 10px">
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="全文搜索">
                </div>
                <button type="button" class="btn btn-info">全文搜索</button>
            </div>
            <div class="col-lg-10 col-md-offset-1" style="background:white; margin-top:10px">
                <h3 class="col-lg-10 col-md-offset-2">联系站长</h3 >
                <h4 v-if="info['qq']">QQ : {{info['qq']}}</h4>
                <h4 v-if="info['email']"> email : {{info['email']}}</h4>
                <h4 v-if="info['mobile']">电话 : {{info['mobile']}}</h4>
            </div>
            <div class="col-lg-10 col-md-offset-1" style="margin-top: 20px;background:white;">
                asdasds
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                info:'',
            }
        },
        created() {
            this.infos()
        },
        methods: {
            infos:function(){
                this.$http.get('/home/Index/info', ).then(
                    (response) => {
                        this.info = response.data[0];
                        console.log(this.info)
                    },
                    (response) => {
                        console.log(response);
                    })
            }
        }
    }
</script>

<style>

</style>