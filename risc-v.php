<?php
$title = "T2M - One Stop Semiconductor IP Cores Provider";
$meta_description = "T2M offers comprehensive Silicon Proven & System Level Semiconductor IP Cores for licensing with pre-integrated Analog solutions";

include('common/header.php');
?>
<style>
  :root {
    --primary-red: #d32f2f;
    --primary-dark: #1a1a2e;
    --primary-blue: #0f3460;
    --accent-blue: #2563eb;
    --light-gray: #f8f9fa;
    --medium-gray: #e9ecef;
    --dark-gray: #495057;
    --white: #ffffff;
    --text-dark: #212529;
    --border-radius: 8px;
    --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}
/* Additional CSS for the sections */
.hero-section {
    /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
    background-image: url('https://t-2-m.com/images/RISC-V-header2.webp');
    color: white;
    padding: 20px 0;
    text-align: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}

.hero-section h1 {
    font-size: 3rem;
    margin-bottom: 20px;
}

.hero-section p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}
 /* Features Section */
        .features-section {
            padding: 25px 0;
            background-color: var(--light-gray);
        }

        .section-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 16px;
        }

        .section-header p {
            font-size: 1.125rem;
            color: var(--dark-gray);
            max-width: 800px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
        }

        .feature-item {
            text-align: center;
            padding: 20px 20px;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-red);
            margin-bottom: 24px;
        }

        .feature-item h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--primary-dark);
        }

        .feature-item p {
            color: var(--dark-gray);
            font-size: 1rem;
        }

        /* CTA Section */
        .cta-section {
            padding: 20px 0;
            background: linear-gradient(135deg, var(--primary-red) 0%, #b71c1c 100%);
            color: var(--white);
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .cta-section p {
            font-size: 1.25rem;
            margin-bottom: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
        }

        .btn {
            display: inline-block;
            padding: 14px 32px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-red);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: #b71c1c;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: var(--white);
            color: var(--primary-red);
        }

        .btn-secondary:hover {
            background-color: var(--medium-gray);
            transform: translateY(-2px);
        }

        /* Product Sections */
        .product-section {
            padding: 80px 50px;
            background-color: var(--white);
        }

        .section-label {
            display: inline-block;
            background-color: var(--primary-red);
            color: var(--white);
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: var(--border-radius);
            margin: 20px 0 30px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .product-item {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--box-shadow);
            border-left: 4px solid var(--primary-red);
            transition: var(--transition);
        }

        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-item h4 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--primary-dark);
        }

        .product-item p {
            color: var(--dark-gray);
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .btn-outline {
            display: inline-block;
            padding: 10px 24px;
            border: 2px solid var(--primary-red);
            color: var(--primary-red);
            text-decoration: none;
            font-weight: 600;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .btn-outline:hover {
            background-color: var(--primary-red);
            color: var(--white);
        }

        /* Automotive Section */
        .automotive-section {
            padding: 20px 10px !important;
            background-color: var(--light-gray);
        }

        .category-heading {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            border-left: 4px solid var(--primary-blue);
            font-weight: 700;
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 20px;
        }

        /* FAQ Section */
        .faq-section {
            padding: 80px 0;
            background-color: var(--white);
        }

        .faq-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 16px;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }

        .faq-question {
            width: 100%;
            text-align: left;
            background-color: var(--light-gray);
            border: none;
            outline: none;
            padding: 20px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }

        .faq-question:hover {
            background-color: var(--medium-gray);
        }

        .faq-question::after {
            content: "\f078";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .faq-question.active::after {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            background: var(--white);
            transition: max-height 0.4s ease;
        }

        .faq-answer p {
            padding: 0 20px 20px;
            color: var(--dark-gray);
        }

        .faq-question.active + .faq-answer {
            max-height: 300px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .section-header h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0;
            }
            
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .hero-section p {
                font-size: 1.1rem;
            }
            
            .features-section, .product-section, .automotive-section, .faq-section, .cta-section {
                padding: 60px 0;
            }
            
            .product-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 15px;
            }
            
            .hero-section h1 {
                font-size: 1.8rem;
            }
            
            .section-header h2 {
                font-size: 1.7rem;
            }
            
            .btn {
                padding: 12px 24px;
            }
        }
        p{
            font-weight: 500 !important;
        }
</style>
<div style="overflow-x: hidden">
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1><strong>RISC-V IP核</strong> <br><span style="font-size: 2rem; font-weight: 600">Cortex M0-A55性能 | 生产验证 | 可定制化 | 安全性</span></h1>
        
        <!-- <a style="background-color: #ff2828;" href="#" class="btn btn-primary">Contact now</a> -->
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <p style="text-align: center; padding-bottom: 2rem; font-size: 16px; font-weight: 400;">我们提供经过硅验证的RISC-V CPU IP核，涵盖从超低功耗MCU到高性能应用处理器的全系列产品。我们的产品组合支持RV32和RV64两种指令集，性能级别相当于Cortex-M0到A55级。主要特性包括向量加密、超标量流水线和ASIL-B/D功能安全。我们的解决方案专为智能物联网、消费电子、汽车、工业和AI边缘系统设计。
        <div class="features-grid">
            <div class="feature-item">
                <i style="font-size: 3rem; color: #ff2828; padding-bottom: 10px" class="fa-solid fa-circle-check"></i>
                 <p>从量产芯片中提取的核</p>
                  <!-- <p>T2M offers a comprehensive range of Silicon Proven & System Level Semiconductor IP Cores.</p> -->
            </div>
              <div class="feature-item">
                <i style="font-size: 3rem; color: #ff2828; padding-bottom: 10px" class="fa-solid fa-lock"></i>
                <p>内置安全与信任根</p>
                 <!-- <p>T2M offers a comprehensive range of Silicon Proven & System Level Semiconductor IP Cores.</p> -->
            </div>
              <div class="feature-item">
                <i style="font-size: 3rem; color: #ff2828; padding-bottom: 10px" class="fa-solid fa-ticket"></i>
                   <p>IP、子系统、软件工具和硬件设计支持</p>
                    <!-- <p>T2M offers a comprehensive range of Silicon Proven & System Level Semiconductor IP Cores.</p> -->
            </div>
             <div class="feature-item">
                <i style="font-size: 3rem; color: #ff2828; padding-bottom: 10px" class="fa-solid fa-microchip"></i>
                <p>具有可调节架构的高级RISC-V扩展。</p>
                 <!-- <p>T2M offers a comprehensive range of Silicon Proven & System Level Semiconductor IP Cores.</p> -->
            </div>
            <div class="feature-item">
                <i style="font-size: 3rem; color: #ff2828; padding-bottom: 10px" class="fa-solid fa-certificate"></i>
                   <p>符合ISO 26262标准的ASIL-B/D认证核</p>
                    <!-- <p>T2M offers a comprehensive range of Silicon Proven & System Level Semiconductor IP Cores.</p> -->
            </div>
          
           
              
        </div>
    </div>
</section>



<!-- General CPU IP Cores Section -->
<section class="product-section">
    <div class="container" style="padding: 0px 27px;">
        <div class="section-header">
            <h2>通用RISC-V IP核</h2>
            <p>可扩展的32位和64位IP核产品组合——从高效嵌入式控制器到高性能计算核，均针对功耗、性能和面积进行了优化。</p>
        </div>
        
        <div class="section-label">32位IP核</div>
        <div class="product-grid">
                <div class="product-item">
                <h4>TGE330</h4>
                <p>TGE330-32位，6级流水线CPU，支持RV32 IMAC/Zc(B)(FD)(P)(Zicond)指令集，双发射，DSP，AXI接口，性能相当于Cortex M7</p>
                <a href="https://t2m-ip.cn/tge330" class="btn-outline">Learn More</a>
            </div>
                   <div class="product-item">
                <h4>TGE320</h4>
                <p>TGE320-32位，3级流水线CPU，支持RV32 IMAC(B)(F)(P)指令集，DSP，浮点单元(FPU)，跟踪功能，CLIC，AHB-Lite接口，性能相当于Cortex M4</p>
                <a href="https://t2m-ip.cn/tge320" class="btn-outline">Learn More</a>
            </div>
                <div class="product-item">
                <h4>TGE315</h4>
                <p>TGE315-32位，3级流水线CPU，支持RV32 IMAC/Zc(B)(F)指令集，浮点单元(FPU)，可信执行环境(TEE)，椭圆曲线加密(ECC)，AXI接口，CLIC，性能相当于Cortex M33</p>
                <a href="https://t2m-ip.cn/tge315" class="btn-outline">Learn More</a>
            </div>
                 <div class="product-item">
                <h4>TGE310</h4>
                <p>TGE310-32位，3级流水线，支持RV32 IMAC指令集，定时器(TIM)，物理内存保护(PMP)，CLIC，AHB接口，性能相当于Cortex M3</p>
                <a href="https://t2m-ip.cn/tge310" class="btn-outline">Learn More</a>
            </div>
                 <div class="product-item">
                <h4>TGE302</h4>
                <p>TGE302-32位，3级流水线，支持RV32 EMZc/C指令集，定时器(TIM)，CLIC，AHB接口，性能相当于Cortex M0+</p>
                <a href="https://t2m-ip.cn/tge302" class="btn-outline">Learn More</a>
            </div>
                  <div class="product-item">
                <h4>TGE200</h4>
                <p>TGE200-32位，2级流水线，支持RV32 IMAC(B)(F)指令集，浮点单元(FPU)，椭圆曲线加密(ECC)，CLIC，性能相当于Cortex M33</p>
                <a href="https://t2m-ip.cn/tge200" class="btn-outline">Learn More</a>
            </div>
            <div class="product-item">
                <h4>TGE100</h4>
                <p>TGE100-32位，2级流水线，支持RV32EMCZc指令集，性能相当于Cortex M0</p>
                <a href="https://t2m-ip.cn/tge100" class="btn-outline">Learn More</a>
            </div>
      
       
       
        
     
        
        </div>
        
        <div class="section-label">64位IP核</div>
        <div class="product-grid">
            <div class="product-item">
                <h4>TGS500</h4>
                <p>TGS500-64位，6级流水线超标量顺序执行，ASIL-B认证，支持RV32 IMAC(B)(FDZfh)(P)(Zicond)指令集，性能相当于Cortex R55</p>
                <a href="https://t2m-ip.cn/tgs500" class="btn-outline">Learn More</a>
            </div>
            <!-- <div class="product-item">
                <h4>XX700</h4>
                <p>64 Bit, 12-stage pipeline superscalar out-of-order 3-way decode RV64 GCB(V), comparable to Cortex A72</p>
                <a href="https://t2m-ip.cn/xx700" class="btn-outline">Learn More</a>
            </div>
            <div class="product-item">
                <h4>XX900</h4>
                <p>64 Bit, 12-stage pipeline superscalar out-of-order 6-way decode RV64GCBVHK, comparable to Cortex Neoverse N2</p>
                <a href="https://t2m-ip.cn/xx900" class="btn-outline">Learn More</a>
            </div> -->
        </div>
    </div>
</section>

<!-- Automotive Section -->
<section class="automotive-section">
    <div class="container" style="padding: 0px 27px;">
        <div class="section-header">
            <h2>安全智能嵌入式RISC-V IP核</h2>
            <p>提供可扩展的RISC-V IP核，专为功能安全(ASIL-B/D)、高性能和低功耗运行设计，适用于汽车和工业应用。</p>
        </div>
        
        <div class="section-label">32位IP核</div>
          <div class="category-heading">
                Safety
            </div>
        <div class="product-grid">
           
         
            <!-- AI Acceleration Products -->
        <div class="product-item">
          <h4>TAE520</h4>
          <p>TAE520-32位，ASIL-D认证，6级超标量顺序流水线，支持RV32 IMAC(B)(FDZfh)(P)(Zicond)指令集，性能相当于Cortex R52</p>
          <a href="https://t2m-ip.cn/tae520" class="btn btn-outline">Know More</a>
        </div>
        <div class="product-item">
          <h4>TAE500</h4>
          <p>TAE500-6级流水线超标量顺序执行，ASIL-B认证，支持RV32 IMAC(B)(FDZfh)(P)(Zicond)指令集，性能相当于Cortex-R5</p>
          <a href="https://t2m-ip.cn/tae500" class="btn btn-outline">Know More</a>
        </div>
        
      <div class="product-item">
          <h4>TAE330</h4>
          <p>TAE330-32位，ASIL-D认证，6级超标量顺序流水线，支持RV32 IMAC(B)(FD)(P)(K)(Zicond)指令集，性能相当于Cortex M7</p>
          <a href="https://t2m-ip.cn/tae330" class="btn btn-outline">Know More</a>
        </div>
          <div class="product-item">
          <h4>TAE320</h4>
          <p>TAE320-32位，3级流水线，ASIL-B认证，安全MCU，DSP，锁步(Lockstep)，性能相当于Cortex-M4
</p>
          <a href="https://t2m-ip.cn/tae320" class="btn btn-outline">Know More</a>
        </div>
        
          <div class="product-item">
          <h4>TAE302</h4>
          <p>TAE302-32位，3级流水线，ASIL-B认证，支持Zc扩展，椭圆曲线加密(ECC)，安全保护内存(SPM)，CLIC，性能相当于Cortex M0+</p>
          <a href="https://t2m-ip.cn/tae302" class="btn btn-outline">Know More</a>
        </div>
      
        </div>
           
        <div class="section-label">64位IP核</div>
      
               <div class="category-heading">
                Safety
            </div>
             <div class="product-grid">
      <div class="product-item">
                <h4>TAS500</h4>
                <p>TAS500-64位，双发射，9级流水线CPU，ASIL-B认证，可信执行环境(TEE)，椭圆曲线加密(ECC)，内存管理单元(MMU)，对称多处理(SMP)，AXI接口，性能相当于Cortex A55</p>
                <a href="https://t2m-ip.cn/tas500" class="btn-outline">Learn More</a>
            </div>
             </div>
    </div>
</section>
<!-- General CPU IP Cores Section -->
<section class="product-section">
    <div class="container" style="padding: 0px 27px;">
        <div class="section-header">
            <h2>专用RISC-V IP核</h2>
            <p>专为AI、NPU和安全嵌入式系统设计的定制RISC-V IP核</p>
        </div>
        
        <!-- <div class="section-label">32-bit IP Cores</div> -->
        <div class="product-grid">
                  <div class="category-heading">
                AI加速(64位)
            </div>
              <div class="category-heading">
              神经网络处理器(NPU)(64位)
            </div>
              <div class="category-heading">
               信息安全(32位)
            </div>
            <div class="product-item">
                <h4>TDS516A</h4>
                <p>TDS516A-64位，双发射，8级流水线超标量顺序执行CPU，支持RVA23架构，向量加密，性能相当于Cortex A55</p>
                <a href="https://t2m-ip.cn/tds516a" class="btn-outline">Learn More</a>
            </div>
            <div class="product-item">
                <h4>TDS350N</h4>
                <p>TDS350N-64位，双发射，8级流水线超标量顺序执行CPU，支持RVV1.0向量扩展，性能相当于Cortex A55</p>
                <a href="https://t2m-ip.cn/tds350n" class="btn-outline">Learn More</a>
            </div>
            <div class="product-item">
                <h4>TDE000S</h4>
                <p>TDE000S-32位，2级流水线，支持RV32 EMC/Zc指令集，性能相当于SC000</p>
                <a href="https://t2m-ip.cn/tde000s" class="btn-outline">Learn More</a>
            </div>
         
        
        </div>
    </div>
</section>
<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <p style=" font-size: 1.7rem; font-weight: 400; color: #fff !important">灵活的IP定制——从核架构到接口，均可根据您的项目需求进行定制。</p>
        <a href="https://t2m-ip.cn/contact.php" class="btn btn-secondary" style="background-color: #fff !important; color: #ff2828;">Contact Us</a>
    </div>
</section>
<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="section-header">
            <h2>常见问题(FAQ)</h2>
        </div>
        <div class="faq-container">
            <div class="faq-item">
                <button class="faq-question">什么是RISC-V？它为什么重要？</button>
                <div class="faq-answer">
                    <p>RISC-V是一种开放标准的指令集架构(ISA)，允许开发人员自由设计和实现处理器，无需授权许可限制。这种开放模式促进创新、降低成本，并支持针对特定应用的定制化开发。</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">我们的RISC-V IP核有何独特之处？</button>
                <div class="faq-answer">
                    <p>我们的RISC-V IP核经过硅验证，已在实际量产芯片中得到验证。我们提供全面的解决方案，包括功能安全认证(ASIL-B/D)、向量处理和加密等高级扩展，以及完整的集成和定制支持。</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">我们的ip核与Cortex处理器相比如何？</button>
                <div class="faq-answer">
                    <p>我们的RISC-V核设计旨在提供与同等Cortex处理器相当的性能，同时具备更高的灵活性、更多的定制选项和更优的成本效益。</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">在集成和开发方面有哪些支持服务？</button>
                <div class="faq-answer">
                    <p>我们提供全面的支持服务，包括文档、软件开发工具包(SDK)、硬件设计服务，以及整个集成过程中的技术支持。我们的团队与客户紧密合作，确保我们的IP核在其设计中成功实施。</p>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<script>
document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const isActive = button.classList.contains('active');
        
        // Close all FAQ items
        document.querySelectorAll('.faq-question').forEach(item => {
            item.classList.remove('active');
        });
        document.querySelectorAll('.faq-answer').forEach(answer => {
            answer.style.maxHeight = null;
        });
        
        // If the clicked item wasn't active, open it
        if (!isActive) {
            button.classList.add('active');
            const answer = button.nextElementSibling;
            answer.style.maxHeight = answer.scrollHeight + 'px';
        }
    });
});
</script>

<?php include('common/footerHome.php'); ?>