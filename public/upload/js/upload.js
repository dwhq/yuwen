//用于文件上传
class Tupload {
    constructor(defaults) {
        let th = this;
        this.defaults = {
            ...{
                url: './upload.php', //上传路径
                title: '上传图片',
                fileNum: 5, // 上传文件数量
                divId: 'T_upload', // div  id
                accept: 'image/jpeg,image/x-png', // 上传文件的类型;
                fileSize: 5 * 1024 * 1024, // 上传文件的大小 5M
                allowFileTypes: ['pdf', 'doc', 'docx', 'jpg', 'gif'], //允许上传文件类型，格式'*.pdf;*.doc;'
                path: 'path', //返回的图片地址字段 默认是path
                formParam: null, //文件以外的配置参数，格式：{key1:value1,key2:value2}
                timeout: 30000, //请求超时时间
                okCode: 200, //与后端返回数据code值一致时执行成功回调，不配置默认200
                images: 'images', //返回路径存储的input表单id
            }, ...defaults
        };
        this.file = '';
        this.num = 0;
        this.numj = 0;
        this.arrFile = [];
        this.createHtml();
        this.operate()
        this.fileImage();
        document.querySelector('#uploadFile').onclick = function () {
            th.uploadFile();
        }
        this.onDelPic();
        this.onLeft();
        this.onRight();
    }

    fileSize(large) {
        let size = large;
        if (large > this.defaults.fileSize) {
            return false;
        } else {
            return size;
        }
    }

    fileType(file) {
        let suffix = file.split('.');
        let type = suffix[suffix.length - 1];
        if (this.defaults.allowFileTypes.indexOf(type) != -1) {
            return suffix;
        } else {
            return false;
        }
    }

    createHtml() {
        if (this.defaults.fileNum < 1 && this.defaults.fileNum == null) {
            this.defaults.fileNum = 5;
        }
        let html = `<div class="uploading-img">
			<p>${this.defaults.title}</p>
			<input type="hidden" id="fileNum" value="0">
			<ul>`
        for (let i = 0; i < this.defaults.fileNum; i++) {
            html += `<li>
						<div class="uploading-imgBg">
						<img id="img_src${i}" class="upload_image" src="images/imgadd.png"/>
						</div>
						<p id="uploadProgress_${i}" class="uploadProgress"></p>
						<p id="uploadTure_${i}" class="uploadTrue"></p>
						<div id="uploading-tip${i}" class="uploading-tip" style="height:'25px';hedisplay: none">
							<span class="onLeft" data="left,${i}" ><</span>
							<span class="onRight" data="rigth,${i}" >></span>
							<i class="onDelPic" data="${i}">x</i>
						</div>
					</li>`
        }
        html +=
            `</ul>
        <input type="hidden" id='${this.defaults.images}' value="">
			<div class="uploading-imgInput">
					<input readonly="readonly" id="fileText" type="text" class="imgInput-file"/>
					<span id="uploadFile">上传</span>
					<div class="andArea">
			 			<div class="filePicker">选择</div>
			 			<input id="fileImage"  name="fileImage" type="file" multiple accept='${this.defaults.accept}'>
					</div>
			 	</div>
			</div>`
        document.querySelector(`#${this.defaults.divId}`).innerHTML = html;
        //添加css样式
        let style = `
        *{padding: 0;list-style: none;}
                .uploading-img{margin-left: auto;margin-right: auto;margin-top: 10px;padding: 20px;position: relative;border: 1px dashed #ccc;    width: 670px;}
                .uploading-img li{overflow: hidden;margin-bottom: 10px;width: 124px;height: 124px;background: url(../images/imgadd.png) no-repeat;position: relative;float: left;margin-right: 10px;}
                .uploading-img li:last-child{margin-right: 0;}
                .uploading-tip{line-height: 25px;box-sizing: border-box;height: 0;width: 100%;position: absolute;bottom: 0;left: 0; background:rgba(0,0,0,0.8);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#b2000000,endColorstr=#b2000000);zoom:1; padding: 0 30px;z-index: 100;}
                :root .uploading-tip{filter:none\\9;}/*for IE9*/	
                .uploading-tip >*{font-style: normal;font-size: 16px;color: green;font-family: "宋体";cursor: pointer;}
                .uploading-tip span:nth-of-type(2){margin-left: 20px;}
                .uploading-tip i{color: red;float: right;font-family: "微软雅黑";}
                .uploading-imgInput{border: 1px solid #C0C0C0;width: 650px;overflow: hidden;height: 40px;margin-top: 20px;}
                .andArea {
                    color: #CCCCCC;
                    font-size: 18px;
                    position: relative;
                    text-align: center;
                    top: -40px;
                    float: right;
                }
                .filePicker {
                    cursor: pointer;
                    background:#00B7EE;
                    border-radius: 3px;
                    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
                    color: #FFFFFF;
                    cursor: pointer;
                    display: inline-block;
                    font-size: 18px;
                    height: 38px;
                    line-height: 38px;
                    min-width: 100px;
                    margin: 0 auto 0px;
                    overflow: hidden;
                    transition: background 0.2s;
                    -moz-transition: background 0.2s;
                    -webkit-transition: background 0.2s;
                    -o-transition: background 0.2s;
                }
                
                #fileImage{cursor: pointer;opacity: 0;position: absolute;width: 100%;height: 100%;top: 0;left: 0;}
                .uploading-imgInput span{
                    font-size: 18px;
                    display: inline-block;
                    height: 38px;
                    line-height: 38px;
                    min-width: 100px;
                   border-left: 1px solid #DFDFDF;text-align: center;cursor: pointer;
                }
                .uploading-imgInput input{border: none;width: 69%;height: 100%;outline: none;padding-left: 10px;}
                .uploading-img ul{overflow: hidden;}
                .uploading-imgBg{position: relative;width: 122px;height: 122px;text-align: center;border: 1px solid #ccc; background: url("../images/bg.png");}
                .uploading-imgBg img{width: 100%;height: auto;}
                .uploading-imgBg img.cur{width: auto;height: 100%;}
                .uploadProgress {display:none; width: 100%;margin: 0;position: absolute;bottom: 0;height: 25px;left: 0px;background: #00B7EE;}
                .uploadTrue{display:none;width: 20px;height:20px;margin: 0;position: absolute;bottom: 0;right: 0px;background: url('../images/TruePng.png') no-repeat;background-size: 100%;}
            `;
        let css = document.createElement("style");
            css.innerHTML= style
        document.querySelector('head').appendChild(css);
    }

    //选择上传文件并判断
    fileImage() {
        let th = this;
        document.querySelector('#fileImage').onchange = function () {

            let events = document.querySelector('#fileImage');
            console.log(events);
            let num = parseInt(document.querySelector('#fileNum').value) + parseInt(events.files.length);
            //console.log(this.arrFile());
            th.arrFile.forEach(function (vo) {
                for (let i = 0; i < parseInt(events.files.length); i++) {
                    if (events.files[i].name == vo.name && events.files[i].size == vo.size) {
                        status = 1;
                    }
                }
            });
            if (num < th.defaults.fileNum + 1 && status != 1) {
                document.querySelector('#fileNum').value = num;
                document.querySelector("#fileText").value = `选中${num}张文件`;
                for (let i = 0; i < parseInt(events.files.length); i++) {
                    //判断文件大小
                    let sizes = th.fileSize(events.files[i].size);
                    if (!sizes) {
                        alert('选择文件过大!');
                        return
                    }
                    let type = th.fileType(events.files[i].name);
                    if (!type) {
                        alert('选择文件类型错误!');
                        return
                    }
                    let j = th.arrFile.push(events.files[i]);
                    th.imgLoad(j - 1, events.files[i]);
                }
            } else {
                if (status != 1) {
                    alert(`只能上传${th.defaults.fileNum}张`);
                }

            }
        }
    }

    //文件上传
    imgLoad(i, file) {
        let r = new FileReader();
        r.readAsDataURL(file);
        let res = this;
        r.onload = function (ev) {
            let src = document.querySelector(`#img_src${i}`).getAttribute('src');
            while (true) {
                if (src != "images/imgadd.png") {
                    i++;
                } else {
                    break;
                }
            }
            res.arrFile[i].result = r.result;
            document.querySelector(`#img_src${i}`).src = r.result;
            //document.querySelector(`#uploading-tip${i}`).style.display = 'block';
            res.setPhotoImg();
        };
    }

    setPhotoImg() {
        let divH = document.querySelectorAll('.uploading-imgBg').offsetHeight;//获取容器高度
        let img = document.querySelectorAll('.upload_image')
        for (let i = 0; i < img.length; i++) {
            let H = document.querySelectorAll('.upload_image')[i].offsetHeight;
            if (H > divH) {
                //当图片高度大于容器高度时
                document.querySelectorAll('.upload_image')[i].style.marginTop = -(H - divH) / 2 + "px";
                //$('.uploading-imgBg img:eq('+i+')').css('margin-top',-(H-divH)/2+"px");
            } else {
                document.querySelectorAll('.upload_image')[i].style.marginTop = (divH - H) / 2 + "px";
                //$(':eq('+i+')').css('margin-top',;
            }
        }
    }

    uploadFile() {
        let th = this;
        if (th.arrFile.length != 0) {
            th.arrFile.forEach(function (vo, key) {
                if (vo['status'] != 1) {
                    th.formUpload(vo, key);
                }
            })
        }
    }

    //文件上传
    formUpload(data, i) {
        let form = new FormData();
        let th = this;
        for (let vo in th.defaults.formParam) {
            //上传额外数据例如 _toke
            form.append(vo, th.defaults.formParam[vo]);
        }
        form.append("file", data);                        	// 文件对象
        // XMLHttpRequest 对象
        let xhr = new XMLHttpRequest();
        xhr.open("post", this.defaults.url, true);
        xhr.onload = function (data) {
            let temp = data.currentTarget.response;//eval('(' + data.currentTarget.response + ')')
            data = JSON.parse(temp)
            document.querySelector(`#uploadProgress_${i}`).style.display = 'block';
            document.querySelector(`#uploadProgress_${i}`).style.margin = 'aout 0';
            if (data.code == th.defaults.okCode) {
                document.querySelector('#images').value += ((i == 0 ? '' : ',') + data.path);
                document.querySelector(`#uploadProgress_${i}`).innerHTML = '上传成功';
                th.arrFile[i]['status'] = 1;
                th.arrFile[i]['path'] = data.path;
            } else {
                document.querySelector(`#uploadProgress_${i}`).innerHTML = '上传失败';
            }
        };
        xhr.send(form);
    }

    //显示出底部的操作框
    operate() {
        document.querySelectorAll('.uploading-img>ul>li').forEach(function (vo, index) {
            vo.onmouseover = function () {
                if (index < document.querySelector('#fileNum').value) {
                    //console.log(vo.querySelector('.uploading-tip'))
                    vo.querySelector('.uploading-tip').style.height = '25px'
                    vo.querySelector('.uploading-tip').style.display = 'block'
                }
            }
            vo.onmouseout = function () {
                //vo.querySelector('.uploading-tip').style.height = '25px'
                vo.querySelector('.uploading-tip').style.display = 'none'
            }
        });
    }

    //删除图片
    onDelPic() {
        let th = this
        document.querySelectorAll('.onDelPic').forEach(function (vo, index) {
            vo.onclick = function () {
                th.arrFile.splice(index, 1);
                document.querySelector(`#img_src${index}`).src = 'images/imgadd.png';
                console.log(th.arrFile)
                th.arrange();
            }
        });
    }

    //元素向左移动
    onLeft() {
        let th = this
        document.querySelectorAll('.onLeft').forEach(function (vo, index) {
            vo.onclick = function () {
                if (index > 0) {
                    let arr = th.arrFile[index];
                    th.arrFile[index] = th.arrFile[index - 1]
                    th.arrFile[index - 1] = arr;
                    th.arrange();
                }
            }
        });
    }

    //元素向右移动
    onRight() {
        let th = this
        document.querySelectorAll('.onRight').forEach(function (vo, index) {
            vo.onclick = function () {
                if (index < th.arrFile.length - 1) {
                    let arr = th.arrFile[index];
                    th.arrFile[index] = th.arrFile[index + 1]
                    th.arrFile[index + 1] = arr;
                    th.arrange();
                }
            }
        });
    }

    //this.arrFile顺序改变对图片显示 以及提交图片地址的顺序 做出更改
    arrange() {
        let th = this
        let path = '';
        th.arrFile.forEach(function (vo, index) {
            document.querySelector(`#img_src${index}`).src = th.arrFile[index].result;
            if (vo.path != '') {
                path += ((index == 0 ? '' : ',') + vo.path);
            }
        });
        document.querySelector('#images').value = path;
    }
}