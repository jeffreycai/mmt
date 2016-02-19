<?php

require_once __DIR__ . DS . '..' . DS . '..' . DS . 'bootstrap.php';

if (is_cli()) {
  $product = new Product();
  $product->setUserId(1);
  $product->setTitle("贝拉米婴儿邮寄奶粉3段");
  $product->setStock(3);
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
  $product->setOriginalPrice('22.00');
  $product->save();
  
  $product = new Product();
  $product->setUserId(1);
  $product->setTitle("葡萄籽精华(金装300粒)");
  $product->setStock(5);
  $product->setThumbnail('modules/product/assets/images/fixture/2.jpg');
  $product->setDescription('协助手、脚和腿的血液循环和保养。 
维持毛细血管的健康。 
可以帮助血液循环。 
支持血管的健康。 
支持血管系统的健康。 
提供抗氧化保护。 ');
  $product->setPrice('25.99');
  $product->setOriginalPrice('29.99');
  $product->save();
  
  
  $product = new Product();
  $product->setUserId(1);
  $product->setTitle("新西兰红印黑糖");
  $product->setStock(10);
  $product->setThumbnail('modules/product/assets/images/fixture/3.jpg');
  $product->setDescription('新西兰Red seal黑糖红糖，自用推荐!!! 
女性必 备好友，非常醇厚的黑糖，效果要比普通红糖好很多，不含糖精，
口感不 同于普通红糖，带一点甘苦味，可以暖宫活血化瘀，补铁养颜，对舒缓痛经，女生手脚冰冷效果显著，
尤其适 用于月经期，产后排毒月子期。痛经的MM吃过都说缓和很多，猛推荐哈！！！！！！
纯正的 黑糖对我们女人真的很好哟，特别是经期产后，
气血不 足的我们，坚持吧每天一勺，
让我们 10年之后和同龄人比的时候，能昂首挺胸的微笑！
别 忘了给家里妈妈多带一罐哦！！');
  $product->setPrice('21.5');
  $product->save();
  
  
  $product = new Product();
  $product->setUserId(1);
  $product->setTitle("Bio-Island 婴幼儿全天然液体乳钙 补钙90粒大包装");
  $product->setStock(0);
  $product->setThumbnail('modules/product/assets/images/fixture/4.jpg');
  $product->setDescription('1、100%澳洲进口优质天然液体乳钙
澳纽地区是全球唯一没有疯牛病和口蹄疫病例的奶源地，供应着全球80%以上的奶源。是全球乳制品监管最严格、最安全、品质最卓越的地方。只有顶级品质的奶源，才能提炼出最优质的乳钙。BIO ISLAND 婴幼儿天然乳钙是全球乳钙来源的首选。

2、Bio Island乳钙是由牛乳中提取的羟基磷酸钙。相较于其他常见的钙补充剂，它最大的特点是易吸收，人体中的钙的存在形式就是羟基磷酸钙晶体，它广泛的分布于骨骼和牙齿中。Bio Island乳钙的成分也是羟基磷酸钙，说它的结构与人体骨质的钙磷比值完全相同。因此，通过羟基磷酸钙补钙易被人体吸收。

3. 相较于葡萄糖酸钙等形式，羟基磷酸钙由于与人体骨钙成份相同，因此补钙效果会更加持久；碳酸钙进入人体后会产生二氧化碳，而二氧化碳会影响消化功能。羟基磷酸钙不会释放二氧化碳。');
  $product->setPrice('29.35');
  $product->save();
}