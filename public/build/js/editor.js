const demoBaseConfig={selector:"#editor",language:"es",width:"100%",height:500,resize:!1,branding:!1,statusbar:!1,menubar:!1,autosave_ask_before_unload:!1,powerpaste_allow_local_images:!0,plugins:["a11ychecker","advcode","advlist","anchor","autolink","codesample","fullscreen","help","image","editimage","tinydrive","lists","link","media","powerpaste","preview","searchreplace","table","tinymcespellchecker","visualblocks","wordcount"],toolbar:"insertfile a11ycheck undo redo | bold italic | forecolor backcolor | codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image | lineheight",spellchecker_dialog:!0,spellchecker_ignore_list:["Ephox","Moxiecode"],tinydrive_demo_files_url:"../_images/tiny-drive-demo/demo_files.json",tinydrive_token_provider:(e,i)=>{e({token:"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJqb2huZG9lIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.Ks_BdfH4CWilyzLNk8S2gDARFhuxIauLa8PwhdEQhEo"})},content_style:"body { font-family:Helvetica,Arial,sans-serif; font-size:16px }"};tinymce.init(demoBaseConfig);const formulario=document.getElementById("formulario");async function actualizarBlog(){const e=new URLSearchParams(window.location.search).get("id"),i=tinymce.activeEditor.getContent(),o=new FormData;o.append("contenido_html",i),o.append("id",e);const a=location.origin+"/public/api/blog",t=await fetch(a,{method:"POST",body:o}),l=await t.json();console.log(l)}formulario.addEventListener("submit",e=>{document.body.style.opacity=0,setTimeout((function(){location.reload()}),500),e.preventDefault(),actualizarBlog()});