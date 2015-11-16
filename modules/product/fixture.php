<?php

require_once __DIR__ . DS . '..' . DS . '..' . DS . 'bootstrap.php';

if (is_cli()) {
  $product = new Product();
  $product->setTitle("贝拉米婴儿邮寄奶粉3段");
  $product->setThumbnail('modules/product/assets/images/fixture/1.jpg');
  $product->setDescription('适合12个月以上的婴儿 
有机牛奶，添加了铁，锌和钙和天然益生元纤维 
澳大利亚制造 
通过NASAA认证的有机认证 
通过ICCV伊斯兰清真认证 
不含BPA锡 
贝拉米有机配方奶粉，是婴儿营养的有效补充！原料取自经过认证的有机牛奶，添加了铁和16种其他必需的维生素和矿物质，以帮助孩子快速增长。配方中还含有菊糖天然益生元纤维，刺激有益菌，保持消化系统健康。 

婴儿有机奶是母乳断奶的首选。贝拉米有机幼儿奶粉通过澳大利亚和新西兰食品标准局（FSANZ）的非常严格的测试。配方牛奶经过澳大利亚农业部的全国协会（NASAA有机认证）-澳大利亚领先的国家认证机构认证。也通过了维多利亚伊斯兰统筹委员会（ICCV）的认证。 ');
  $product->setPrice('19.99');
  $product->save();
  
  $product = new Product();
  $product->setTitle("葡萄籽精华(金装300粒)");
  $product->setThumbnail('modules/product/assets/images/fixture/2.jpg');
  $product->setDescription('协助手、脚和腿的血液循环和保养。 
维持毛细血管的健康。 
可以帮助血液循环。 
支持血管的健康。 
支持血管系统的健康。 
提供抗氧化保护。 ');
  $product->setPrice('25.99');
  $product->save();
}