let mix = require('laravel-mix');
let fs = require('fs');
let path = require('path');

//启用版本控制
mix.version();

//解析需要遍历的文件夹
let assetsPath = 'resources/assets/';
let windowsAssetsPath = 'resources\\assets\\';
let publicPath = 'public/';

//process.exit();
//调用文件遍历方法
assetsCompile(assetsPath);

/**
 * 遍历文件
 */
function assetsCompile(targetPath){
    fs.readdir(targetPath,function(err,files){
        if(err){
            console.warn(err);
        }else{
            //遍历读取到的文件列表
            files.forEach(function(filename){
                //获取当前文件的绝对路径
                var filedir = path.join(targetPath,filename);
                //根据文件路径获取文件信息，返回一个fs.Stats对象
                fs.stat(filedir,function(eror,stats){
                    if(eror){
                        console.warn('获取状态失败');
                    }else{
                        var isFile = stats.isFile();//文件
                        var isDir = stats.isDirectory();//文件夹
                        if(isFile){
                            //获取后缀名
                            var suffix_arr = filename.split(".");
                            var suffix = suffix_arr.pop();
                            var img_arr = ['jpg','jpeg','png','gif','ico'];
                            if(img_arr.indexOf(suffix) >= 0){
                                suffix = 'img';
                            }

                            //替换windows路径、linux路径
                            var targetdir = publicPath + filedir.replace(windowsAssetsPath,'').replace(assetsPath,'');
                            //判断文件类型并调用不同的编译函数
                            switch(suffix){
                                case 'css':
                                    compileCss(filedir, targetdir);
                                    break;
                                case 'js':
                                    compileJs(filedir, targetdir);
                                    break;
                                case 'img':
                                    compileImg(filedir, targetdir);
                                    break;
                                case 'json':
                                    compileOther(filedir, targetdir);
                                    break;
                                default:
                                    break;
                            }
                        }
                        if(isDir){
                            assetsCompile(filedir);//如果是文件夹，递归
                        }
                    }
                });
            });
        }
    });
}

//未启用编译前，compileCss与compileJs无区别
function compileCss(asset, target){
    mix.copy(asset, target);
}

function compileJs(asset, target){
    mix.copy(asset, target);
}

function compileImg(asset, target){
    mix.copy(asset, target);
}

function compileOther(asset, target){
    mix.copy(asset, target);
}