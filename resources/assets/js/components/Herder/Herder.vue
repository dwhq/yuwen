<template>
    <div>
        <!--导航栏-->
        <div class="row" style="padding-top: 10px">
            <div class="col-md-2 col-md-offset-2">
                <img :src="imgUrl+info.image" :alt="info.name">
            </div>
            <div class="col-md-3 col-md-offset-3">
                <ul class="nav nav-pills">
                    <li v-for="list in data"  :class="list.type==type?'active':''"><a @click="column_type(list.type)" href="#">{{list.name}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                data:'',
                type: '',
                info:''
            };
        },
        created() {
          this.column()
            this.infos()
        },
        methods: {
            column:function(){
                this.$http.get('/home/Index/column', ).then(
                        (response) => {
                            this.data = response.data;
                            this.type = this.data[0]['type']//设置第一个为默认
                            console.log(this.data)
                        },
                        (response) => {
                            console.log(response);
                        })
            },
            column_type:function (type) {
                //点击的时候更换文章类型
                this.type = type
            },
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

    .el-col {
        border-radius: 4px;
    }
    .bg-purple-dark {
        background: #99a9bf;
    }
    .bg-purple {
        background: #d3dce6;
    }
    .bg-purple-light {
        background: #e5e9f2;
    }
    .grid-content {
        border-radius: 4px;
        min-height: 36px;
    }
    .row-bg {
        padding: 10px 0;
        background-color: #f9fafc;
    }
</style>