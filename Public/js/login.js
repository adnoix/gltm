$(document).ready(function(){
		//缁欑櫥褰曟寜閽坊鍔犱簨浠�
		if(top.location!=self.location){
			top.location = self.location;
		}
		
		$("#login").click(function(){
			var username=$("#username").attr("value");
			var password=$("#password").attr("value");
			var user={UserName:username,PassWord:password};
			$.ajax({
				url:"login",
				type:"post",
				data:user,
				timeout:3000,
				success:function(data){
					switch(data.state)
					{
					case 0:
						alert(data.msg);
						break;
					case 1:
						window.location.href=data.url;
						break;
					}
				},
                error: function (xmlHttpRequest, error) {
                     alert("瓒呮椂锛岃纭鏈嶅姟鍣ㄦ甯�");
                     top.location.reload();
                 }
			});
		});	
	});