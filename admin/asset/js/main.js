    jQuery(document).ready(function(){
       
         jQuery(".fme_nb_tb_active_tab").click(function() {
         
      //  remove classes from all
        jQuery(".fme_nb_tb_active_tab").removeClass("fme_nb_tb_active_tab");
       jQuery(this).addClass("fme_nb_tb_active_tab");
         });
        jQuery('#fme_nb_General').click(function(){
         jQuery(".fme_nb_tb_active_tab").removeClass("fme_nb_tb_active_tab");
         jQuery(this).find('a').addClass("fme_nb_tb_active_tab");
         jQuery('.fme_nb_Content').hide();
         jQuery('.fme_nb_General').show();
         jQuery('.fme_nb_css').hide();
         
      });
     jQuery('#fme_nb_content').click(function(){
      
      jQuery('.fme_nb_Content').show();
      jQuery('.fme_nb_General').hide();
      jQuery('.fme_nb_css').hide();
     });
      jQuery('#fme_nb_css').click(function(){
     jQuery('.fme_nb_Content').hide();
     jQuery('.fme_nb_General').hide();
     jQuery('.fme_nb_css').show();
   });
   
       jQuery('.fme_nb_btn_save').click(function()   
       {
       var checkbox =jQuery('#fme_nb_checkboxs').prop("checked");
       var tb_postion =jQuery('.fme_nb_wc-tb_postion').val();
       var visible_type =jQuery('.fme_nb_wp-visible_type').val();
        var color_bg =jQuery('.fme_nb_color_bg').val();
        var color_text =jQuery('.fme_nb_color_text').val();
        var topbarjax_url = mytabkAjax.ajaxurl;
         jQuery.ajax({ 
           type: 'POST',
           url: topbarjax_url,
           data: {
           action:'topbarajax',
           checkbox:checkbox,
            tb_postion:tb_postion ,
            visible_type:visible_type,
            color_bg:color_bg,
            color_text:color_text,
        },
        success: function(response) {
            // console.log(response);
        setTimeout(function(){
             jQuery('.loader').css('display' , 'block');
          }, 100);
            setTimeout(function(){
             jQuery('.loader').css('display','none');
          }, 1000);      
       }
       });
       });

        // Message_save
         jQuery('.fme_nb_Message_save').click(function()
       {
       var textarea =jQuery('.fme_nb_textarea').val();
        var button_text =jQuery('.fme_nb_button_text').val();
        var button_url =jQuery('.fme_nb_button_url').val();
         var  behavior_tab =jQuery('.fme_nb_behavior_tab').val();  
         var btn_colors = jQuery('#fme_nb_btn_colors').val();
          var btn_texts = jQuery('#fme_nb_btn_texts').val();
        var topbarjax_url = mytabkAjax.ajaxurl;
         jQuery.ajax({ 
           type: 'POST',
           url: topbarjax_url,
           data: {
           action:'textbarajax',
           textarea:textarea,
           button_text :button_text,
           button_url :button_url,
           behavior_tab :behavior_tab,
           btn_colors:btn_colors,
           btn_texts:btn_texts
        },
        success: function(response) {
            // console.log(response);
             setTimeout(function(){
             jQuery('.loader').css('display','block');
          }, 100);
            setTimeout(function(){
             jQuery('.loader').css('display','none');
          }, 1000); 

     }
    });
    });
     
             // css_save button
          jQuery('.fme_nb_css_save').click(function()
       {
         
       var set_width =jQuery('.fme_nb_set_width').val();
       var set_height =jQuery('.fme_nb_set_height').val();
       var wp_px_percent=jQuery('.fme_nb_wp_px_percent').val();
       var  px =jQuery('.fme_nb_px').val(); 

       var topbarjax_url = mytabkAjax.ajaxurl;
         jQuery.ajax({ 
           type: 'POST',
           url: topbarjax_url,
           data: {
           action:'cssajax',
           set_width:set_width,
           set_height :set_height,
            px :px ,
            wp_px_percent:wp_px_percent

        },
        success: function(response) {
            //console.log(response);
             setTimeout(function(){
             jQuery('.loader').css('display','block');
          }, 100);
            setTimeout(function(){
             jQuery('.loader').css('display','none');
          }, 1000); 
            
       }
         
         });
          });  
             });  
     
