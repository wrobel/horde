CKEDITOR.dialog.add("anchor",function(d){var c=function(j,i,h){var a=this;a.editMode=true;a.editObj=h;var b=a.editObj.getAttribute("name");if(b){a.setValueOf("info","txtName",b)}else{a.setValueOf("info","txtName","")}};return{title:d.lang.anchor.title,minWidth:300,minHeight:60,onOk:function(){var a=this;var h=a.getValueOf("info","txtName"),g=CKEDITOR.env.ie&&!(CKEDITOR.document.$.documentMode>=8)?d.document.createElement('<a name="'+CKEDITOR.tools.htmlEncode(h)+'">'):d.document.createElement("a");if(a.editMode){a.editObj.copyAttributes(g,{name:1});a.editObj.moveChildren(g)}g.data("cke-saved-name",false);g.setAttribute("name",h);var b=d.createFakeElement(g,"cke_anchor","anchor");if(!a.editMode){d.insertElement(b)}else{b.replace(a.fakeObj);d.getSelection().selectElement(b)}return true},onShow:function(){var a=this;a.editObj=false;a.fakeObj=false;a.editMode=false;var f=d.getSelection(),b=f.getSelectedElement();if(b&&b.data("cke-real-element-type")&&b.data("cke-real-element-type")=="anchor"){a.fakeObj=b;b=d.restoreRealElement(a.fakeObj);c.apply(a,[d,f,b]);f.selectElement(a.fakeObj)}a.getContentElement("info","txtName").focus()},contents:[{id:"info",label:d.lang.anchor.title,accessKey:"I",elements:[{type:"text",id:"txtName",label:d.lang.anchor.name,required:true,validate:function(){if(!this.getValue()){alert(d.lang.anchor.errorName);return false}return true}}]}]}});