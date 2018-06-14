class Tupload {
    constructor(defaults) {
        this.defaults = defaults
        // {
        //         url: '', //上传路径
        //         title: '余温2',
        //         fileNum: 5, // 上传文件数量
        //         divId: 'T_upload', // div  id
        //         accept: 'image/jpeg,image/x-png', // 上传文件的类型;
        //         fileSize: 51200, // 上传文件的大小KB*1024
        //         allowFileTypes: ['pdf', 'doc', 'docx', 'jpg', 'gif'], //允许上传文件类型，格式'*.pdf;*.doc;'
        //         path: 'path', //返回的图片地址字段 默认是path
        //         formParam: null, //文件以外的配置参数，格式：{key1:value1,key2:value2}
        //         timeout: 30000, //请求超时时间
        //         okCode: 200, //与后端返回数据code值一致时执行成功回调，不配置默认200
        //         images: 'images' 返回路径存储的input表单id
        //     },
            this.file = '';
            this.num = 0;
            this.numj = 0;
            this.arrFile = [];
            this.createHtml();
            this.fileImage();
            this.uploadFile();
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
        let type = suffix[suffix.length-1];
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
							<span class="onLandR" data="left,${i}" ><</span>
							<span class="onLandR" data="rigth,${i}" >></span>
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
    }
    //选择上传文件并判断
    fileImage(){
    	let th = this;
    	document.querySelector('#fileImage').onchange =function(){
    		
    		let events = document.querySelector('#fileImage');
    		console.log(events);
			let num =parseInt(document.querySelector('#fileNum').value)+parseInt(events.files.length);
			//console.log(this.arrFile());
			th.arrFile.forEach(function(vo){
				for(let i=0 ; i < parseInt(events.files.length); i++){
					if (events.files[i].name == vo.name && events.files[i].size == vo.size) {
						status = 1;
					}
				}
			});
			if(num < th.defaults.fileNum+1 && status != 1 ){
							document.querySelector('#fileNum').value = num;
							document.querySelector("#fileText").value=`选中${num}张文件`;
							for(let i=0 ; i < parseInt(events.files.length); i++){
								//判断文件大小
								let sizes =th.fileSize(events.files[i].size);
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
								th.imgLoad(j-1,events.files[i]);
							}
						}else{
							if (status != 1) {
								alert(`只能上传${th.defaults.fileNum}张`);
							}
							
						}
			}
    }
    //文件上传
    imgLoad(i,file){
    	let r = new FileReader();
    	r.readAsDataURL(file);
    	let res = this;
    	r.onload = function(ev){
    		let src = document.querySelector(`#img_src${i}`).getAttribute('src');
					while(true){
						if(src != "images/imgadd.png"){
							i++;
						}else{
							break;
						}
					}
					document.querySelector(`#img_src${i}`).src=	r.result;
					document.querySelector(`#uploading-tip${i}`).style.display='block';
					res.setPhotoImg();
				};		
    }
    setPhotoImg(){
    	let divH = document.querySelectorAll('.uploading-imgBg').offsetHeight;//获取容器高度
		let img = document.querySelectorAll('.upload_image')
			for(let i=0;i<img.length;i++){
				let H = document.querySelectorAll('.upload_image')[i].offsetHeight;
				if(H>divH){
					//当图片高度大于容器高度时
					document.querySelectorAll('.upload_image')[i].style.marginTop= -(H-divH)/2+"px";
					//$('.uploading-imgBg img:eq('+i+')').css('margin-top',-(H-divH)/2+"px");
				}else{
					document.querySelectorAll('.upload_image')[i].style.marginTop = (divH-H)/2+"px";
					//$(':eq('+i+')').css('margin-top',;
				}
			}
    }
    uploadFile(){
    	let th = this;
    	document.querySelector('#uploadFile').onclick =function(){
           if(th.arrFile.length != 0){
	    		th.arrFile.forEach(function(vo,key){
	    			if (vo['status']!=1) {
	    				th.formUpload(vo,key);
	    			}
    			})
    		}
        }
    	
    }
    //文件上传
    formUpload(data,i){
    	let form = new FormData();
    		let th = this;
    		for(let vo in th.defaults.formParam  ){
    			//上传额外数据例如 _toke
				form.append(vo,th.defaults.formParam[vo]);
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
	    		 let path = th.defaults.path
		    	 document.querySelector(`#${th.defaults.images}`).value += ((i==0?'':',')+data.path);
		    	 document.querySelector(`#uploadProgress_${i}`).innerHTML = '上传成功';
		    	 th.arrFile[i]['status'] = 1;
		    	}else {
	    		document.querySelector(`#uploadProgress_${i}`).innerHTML = '上传失败';
		    	}
		    };
		    xhr.send(form);
    }
}
// function mOver(obj){
// 	obj.innerHTML="Thank You"
// }
window.onload = function(){
	//console.log(document.querySelectorAll('.uploading-img>ul>li'))
	document.querySelectorAll('.uploading-img>ul>li').forEach( function(vo, index) {
		vo.onmouseover = function(){
			if (index < document.querySelector('#fileNum').value) {
				//console.log(vo.querySelector('.uploading-tip'))
				vo.querySelector('.uploading-tip').style.height = '25px'
				vo.querySelector('.uploading-tip').style.display = 'block'
			}
		}
		vo.onmouseout = function(){
			//vo.querySelector('.uploading-tip').style.height = '25px'
			vo.querySelector('.uploading-tip').style.display = 'none'
		}
	});	
}