const http = require('http');
const fs = require('fs');
http.get('http://www.yywxx.com/forum-36-1.html',(res)=>{
  //res是对方服务器给我们的一个回应对象
  res.setEncoding('binary');//把响应内容当成二进制处理，不考虑编码
  var body = '';
  res.on('data',(chunk)=>{
    body +=chunk;
  });
  res.on('end',()=>{
    fs.writeFile('news2.txt', body,'binary',()=>{
      console.log('采集完成');
    });

  });
});
