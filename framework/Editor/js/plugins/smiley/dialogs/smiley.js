CKEDITOR.dialog.add("smiley",function(B){var A=B.config,z=B.lang.smiley,y=A.smiley_images,x=A.smiley_columns||8,w,v,u=function(f){var e=f.data.getTarget(),d=e.getName();if(d=="a"){e=e.getChild(0)}else{if(d!="img"){return}}var c=e.getAttribute("cke_src"),b=e.getAttribute("title"),a=B.document.createElement("img",{attributes:{src:c,"data-cke-saved-src":c,title:b,alt:b,width:e.$.width,height:e.$.height}});B.insertElement(a);v.hide();f.data.preventDefault()},t=CKEDITOR.tools.addFunction(function(f,e){f=new CKEDITOR.dom.event(f);e=new CKEDITOR.dom.element(e);var d,c,b=f.getKeystroke(),a=B.lang.dir=="rtl";switch(b){case 38:if(d=e.getParent().getParent().getPrevious()){c=d.getChild([e.getParent().getIndex(),0]);c.focus()}f.preventDefault();break;case 40:if(d=e.getParent().getParent().getNext()){c=d.getChild([e.getParent().getIndex(),0]);if(c){c.focus()}}f.preventDefault();break;case 32:u({data:f});f.preventDefault();break;case a?37:39:case 9:if(d=e.getParent().getNext()){c=d.getChild(0);c.focus();f.preventDefault(true)}else{if(d=e.getParent().getParent().getNext()){c=d.getChild([0,0]);if(c){c.focus()}f.preventDefault(true)}}break;case a?39:37:case CKEDITOR.SHIFT+9:if(d=e.getParent().getPrevious()){c=d.getChild(0);c.focus();f.preventDefault(true)}else{if(d=e.getParent().getParent().getPrevious()){c=d.getLast().getChild(0);c.focus();f.preventDefault(true)}}break;default:return}}),s=CKEDITOR.tools.getNextId()+"_smiley_emtions_label",r=['<div><span id="'+s+'" class="cke_voice_label">'+z.options+"</span>",'<table role="listbox" aria-labelledby="'+s+'" style="width:100%;height:100%" cellspacing="2" cellpadding="2"',CKEDITOR.env.ie&&CKEDITOR.env.quirks?' style="position:absolute;"':"","><tbody>"],q=y.length;for(w=0;w<q;w++){if(w%x===0){r.push("<tr>")}var p="cke_smile_label_"+w+"_"+CKEDITOR.tools.getNextNumber();r.push('<td class="cke_dark_background cke_centered" style="vertical-align: middle;"><a href="javascript:void(0)" role="option"',' aria-posinset="'+(w+1)+'"',' aria-setsize="'+q+'"',' aria-labelledby="'+p+'"',' class="cke_smile cke_hand" tabindex="-1" onkeydown="CKEDITOR.tools.callFunction( ',t,', event, this );">','<img class="cke_hand" title="',A.smiley_descriptions[w],'" cke_src="',CKEDITOR.tools.htmlEncode(A.smiley_path+y[w]),'" alt="',A.smiley_descriptions[w],'"',' src="',CKEDITOR.tools.htmlEncode(A.smiley_path+y[w]),'"',CKEDITOR.env.ie?" onload=\"this.setAttribute('width', 2); this.removeAttribute('width');\" ":"",'><span id="'+p+'" class="cke_voice_label">'+A.smiley_descriptions[w]+"</span></a>","</td>");if(w%x==x-1){r.push("</tr>")}}if(w<x-1){for(;w<x-1;w++){r.push("<td></td>")}r.push("</tr>")}r.push("</tbody></table></div>");var o={type:"html",html:r.join(""),onLoad:function(a){v=a.sender},focus:function(){var a=this;setTimeout(function(){var b=a.getElement().getElementsByTag("a").getItem(0);b.focus()},0)},onClick:u,style:"width: 100%; border-collapse: separate;"};return{title:B.lang.smiley.title,minWidth:270,minHeight:120,contents:[{id:"tab1",label:"",title:"",expand:true,padding:0,elements:[o]}],buttons:[CKEDITOR.dialog.cancelButton]}});