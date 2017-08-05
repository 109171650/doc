const os = require('os');
console.log('cpu：'+os.arch());
console.log('物理内存：'+Math.floor( os.totalmem()/1000/1000)+'M');
console.log('可用内存：'+Math.floor( os.freemem()/1000/1000)+'M');
console.log('平台：'+os.platform());
console.log('系统类型：'+os.type());
console.log('操作系统版本：'+os.release());
console.log('连续运行时间：'+Math.floor(os.uptime()/60))+'分钟';
console.log('系统缓存目录：'+os.tmpdir());
