<style>
.news-block .inner-box .image {
    height: 208px;
    }
.news-block .inner-box .lower-content {
    height: 225px;
    }
 .sidebar1 .popular-tags a {
    position: relative;
    display: inline-block;
    line-height: 24px;
    padding: 8px 50px 8px;
    margin: 0px -4px 10px 0px;
    color: #FFFDFD;
    text-align: center;
    font-size: 15px;
    font-weight: 600;
    text-transform: capitalize;
    transition: all 300ms ease;
    -webkit-transition: all 300ms ease;
    -ms-transition: all 300ms ease;
    -o-transition: all 300ms ease;
    -moz-transition: all 300ms ease;
} 
.sidebar1 .popular-tags a:hover{
	background:#FC5219;
	color:#EFD913;	
}  
.facebook{background: #3b5998;}
.twitter{background: #55acee;}
.whatsapp{background: #25d366;}

    </style>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(../public/assets/images/kantor.jpg)">
    	<div class="auto-container">
        	<h2><?= $nav ?></h2>
            <ul class="page-breadcrumb">
            	<li><a href="">home</a></li>
                <li><?= $nav ?></li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<!--Sidebar Page Container-->
    <div class="sidebar-page-container">
    	<div class="auto-container">
        	<div class="row clearfix">
            	
                <!--Content Side / Blog Classic -->
                <div class="content-side col-xl-12 col-lg-10 col-md-12 col-sm-12">
                	<div class="blog-single padding-right">
						<div class="inner-box">
							
                            <div class="lower-content">
                                
								<div class="lower-box">
									<h3><?= $single['title'] ?></h3>
                                    <div class="post-meta sidebar1">
                                    
                                    <span class="popular-tags" id="fb">
                                     <a class="facebook" href="http://www.facebook.com/sharer.php?u=<?= Dee::createUrl('read/' . $single['slug']) ?>"target="_blank" ><i class="fab fa-facebook-f"></i>&nbsp;Fb</a>
			                         <a class="twitter" href="http://twitter.com/share?url=<?= Dee::createUrl('read/' . $single['slug']) ?> "target="_blank" ><i class="fab fa-twitter"></i>&nbsp;Tweet</a>
			                         <a class="whatsapp" href="https://api.whatsapp.com/send?text=<?= Dee::createUrl('read/' . $single['slug']) ?>" target="_blank" ><i class="fab fa-whatsapp" ></i>&nbsp;Wa</a>
	                              </span>
                                  </div>
									<div class="text">
										<?= $single['content'] ?>(**).	</div>
								</div>
							</div>
						</div>
                        
                    	<div id="comments" class="comments-area">

		<div id="respond" class="comment-respond">
        <div id="fb-root"></div>
<script> //<![CDATA[
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
//]]> </script>

		

    	</div><!-- #respond -->
	
</div><!-- #comments -->

                      
                       
                        
                    </div>
				</div>
				
				<!--Sidebar Side-->
				
				
			</div>
		</div>
	</div>
	
