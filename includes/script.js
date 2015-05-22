	$(function() {
		$( "#favourDatepicker" ).length;
		if($( "#favourDatepicker" ).length){
			$( "#favourDatepicker" ).datepicker({ minDate: 0, dateFormat: 'yy-mm-dd' });
		}
	});	

	$(function(){
		$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'action' : 'checkNewMessages' }, function(data){
			var unread = data['unread'];
			if(unread==true){
				//var size = data['size'];
				//alert("found new messages");
				$('#viewMessagesNav').text("Messages (New)");
			}
	});
	
	$(function(){
		$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'action' : 'checkActiveValue' }, function(data){
			var active = data['active'];
			if(active==true){
				//alert("Welcome to RHUL | LETS. It is highly recommended that the first thing you do is to change your password");
			}
		});
	});	

	$(document).ready(function(){

		//checkNewMessages();checkHiddenValue(true,true,'#dynamicInfoMasterDiv');

		function checkHiddenValue(verificationCheck1, verificationCheck2, id){
			if(verificationCheck1&&verificationCheck2){
				$(id).prop('hidden',false);
			}
			else{
				$(id).prop('hidden',true);
			}

		}

		function checkSubmitValue(verificationCheck1, verificationCheck2, id){
			if(verificationCheck1&&verificationCheck2){
				$(id).prop('disabled',false);
			}
			else{
				$(id).prop('disabled',true);
			}

		}

		var emailCheck=false;
		var passwordCheck=false;
		var editCurrentPasswordCheck = false;
		var editNewPasswordCheck = false;
		var searchFormCheck = false;
		var favourFormValueCheck = false;
		var favourDatepickerCheck = false;
		var sendMessageEmailCheck = false;
		var sendMessageContentsCheck = false;
		var sendMessageSubjectCheck = false;

		if($('#divSearchResults').length>0){
			console.log("exists");

				
			//Fill the search results with data
		}

		

		$('#skillList').off('change').on('change',function(e){
			e.preventDefault();
			alert("changed");

			var skillIndex= e.target.id;

			//var skillLevel=e.target.val;

			var skillLevel= $('#'+skillIndex).val();

			console.log("id: "+ skillIndex+ " newLevel: "+ skillLevel);
			//get id of changed option


			//send update to db.
			//var id = (e.target.id);
			//var id = $(e.target.id).parent.attr("id");
			//alert(id);

			//$(this).parent().attr("id");

			//var skillLevel = $(this).val();
			//var skill = 
			//var skillType

			//alert("val= "+ skillLevel);
			console.log("about to go to phpFunc");
			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'action' : 'updateSkillLevel' ,'skillIndex':skillIndex, 'skillLevel':skillLevel}, function(data){
				console.log("returned from phpFunc");



			});
		});
		
		$('#newSkillSubmit').off('click').on('click',function(e){
			e.preventDefault();


			console.log('newSkillSubmit');

			var skillType = $('#newSkillType').val();
			var skillLevel = $('#newSkillLevel').val();
			var skillName = $('#newSkillInput').val();

			console.log('about to enter phpFunctions:skillSubmit');

			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'newSkill':'true', 'action' : 'skillSubmit' ,'skillLevel':skillLevel,'skillName' : skillName , 'skillType': skillType}, function(data){
				console.log("returned from phpFunctions:skillSubmit");
				var verified = data['verified'];
				console.log(data['message']);
				//console.log('verified: '+verified);
				//console.log('content : '+data['content']);
				$('#newSkillType').prop('selectedIndex',0);
				$('#newSkillInput').empty();
				$('#newSkillLevel').prop('selectedIndex',0);
			});
		});
		$('#newSkillInput').off('keyup').on('keyup',function(e){
			e.preventDefault();
			//console.log("newSkillInput");
			var newSkill = $('#newSkillInput').val();
			var newSkillSubmitBool = false;
			if(!newSkill){
				console.log('empty');
				newSkillSubmitBool = false;
			}
			else{
				newSkillSubmitBool = true;
			}
			checkSubmitValue(newSkillSubmitBool,true, '#newSkillSubmit');
		});

		$('#selectSkillForm').off('change').on('change',function(e){
			e.preventDefault();
			console.log('selectSkillForm');
			var skillType = $('#selectSkillType').val();
			var skillLevel = $('#selectSkillLevel').val();
			if (!skillLevel){//} || !skillName || !skillType){
				//alert('skill level warning');
			}
			else if (!skillType){
				//alert('skill type warning');
			}
			else{
				//alert('skill selection ok');				
				checkSubmitValue(true,true, '#selectSkillSubmit');
			}
		});

		$('#selectSkillSubmit').off('click').on('click',function(e){
			e.preventDefault();//Don't forget this...!!!

			console.log('selectSkillSubmit');
			var skillType = $('#selectSkillType').val();
			var skillLevel = $('#selectSkillLevel').val();
			var skillName = $('#selectSkillName').val();

			console.log('about to enter phpFunctions:skillSubmit');

			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'newSkill':'false', 'action' : 'skillSubmit' ,'skillLevel':skillLevel,'skillName' : skillName , 'skillType': skillType}, function(data){
				console.log("returned from phpFunctions:skillSubmit");
				var verified = data['verified'];
				console.log(data['message']);
				//console.log('verified: '+verified);
				//console.log('content : '+data['content']);
				$('#selectSkillType').prop('selectedIndex',0);
				$('#selectSkillName').empty();
				$('#selectSkillLevel').prop('selectedIndex',0);
			});

		});
		$('#selectSkillType').off('change').on('change',function(e){
			e.preventDefault();
			var skillType = $('#selectSkillType').val();
			//alert('changed');
			//alert('skill type : '+skilltype);

			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'action' : 'getSkillList' ,'skillType': skillType}, function(data){
				var verified = data['verified'];
				$('#selectSkillName').empty();
				//alert(verified);
				var skillString = data['skillString'];
				//alert(skillString);
				$('#selectSkillName').append(skillString);
			});
					
		});

		$('#goBackButton').off('click').on('click',function(e){
			e.preventDefault();
			alert("Go back to the fiery chasm from whence you came");


			//do stuff
			window.history.go(-2);


			//use the id for data in the page, and make an ajax request, in the ajax make the call to php to make the necessary updates to the db
		});


		$('#sendMessageRecipient').off('keyup').on('keyup',function(e){
			e.preventDefault();

			$('#dynamicUserInfo').empty();

			//alert("no more empty");
			var recipient = $('#sendMessageRecipient').val();
			if(recipient ===""){
				//do nothing
				//alert("nothing");
				$('#dynamicUserInfo').append("<p>Type an email address in the email box.</p>")
			}
			else{
				$.post('http://46.101.34.183/mvc/mvc/includes/checkUsername.php', { 'email' : recipient }, function(data){
					
					var verified = data['verified'];
					if(verified===true){
						$('#dynamicUserInfo').append("<p>Valid user.</p>")
						sendMessageEmailCheck=true;
					}
					else if(verified===false){
						$('#dynamicUserInfo').append("<p>User does not exist.</p>")
						sendMessageEmailCheck=false;
					}
					checkSubmitValue(sendMessageEmailCheck,sendMessageContentsCheck,'#sendMessageSubmit');
				});	
			}
		});


		$('#sendMessageForm').on('change',function(e){
			e.preventDefault();

			$('#dynamicUserInfo').empty();

			var content = $('#sendMessageContent').val();
			var subject = $('#sendMessageSubject').val();

			if(content =="" || subject ==""){	
				sendMessageContentsCheck = false;
				$('#dynamicUserInfo').append("<p>Enter some text in the box.</p>");
			}
			else{
				sendMessageContentsCheck=true;
			}
			checkSubmitValue(sendMessageEmailCheck,sendMessageContentsCheck, '#sendMessageSubmit');

		});


		$('#sendMessageSubmit').off('click').on('click',function(e){
			e.preventDefault();//Don't forget this...!!!
			alert('submit');

			var recipient = $('#sendMessageRecipient').val();
			var content = $('#sendMessageContent').val();
			var subject = $('#sendMessageSubject').val();

			console.log(recipient);
			console.log(content);
			console.log(subject);
			console.log("about to enter phpFunctions:sendMessage");
			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', {'action':'sendMessage','recipient': recipient,'content':content,'subject':subject}, function(data){
				console.log("returned");
				//do stuff with the returned data value
				if(data['verified']===true){
					alert('worked');
				}
				else{
					alert('didn"t work');
				}
			});

		});


		$('#doOver').off('click').on('click',function(e){
			$('#sendMessageForm').find("input[type=text], textarea").val("");//NICE!!! works a charm for clearing all content in form
		});
		$('#confirmFavourButton').off('click').on('click',function(e){
			e.preventDefault();

			alert("Vanilla is delicious");

			/*
			var pid = $('#div_pid').text();
			var favour_cost = $('#');
			*/

			//alert(pid);

			//do stuff, call make transaction, and access stored session array
			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', {'action':'makeTransaction'}, function(data){
				//do stuff with the returned data value
				if(data['verified']===true){
					alert('ding dong');
				}
				else{
					alert('didn"t work');
				}
			});
			//return the browser to the previous page
		});
		
		$('#selectFavourLink').off('click').on('click', function(e){
			//e.preventDefault();

			//transfer to a new page to summarise the outcome of the transaction.
			//do stuff to transfer the credits, and make the transaction, 
			alert("selected");
		})

		$('#searchFormSubmit').off('click').on('click', function(e){
			e.preventDefault();

			var searchFormUsers = false;
			var searchFormPosts = false;
			var searchFormSkills = false;
			var searchFormEntry = $('#searchFormEntry').val();
			
			
			if ($('#searchFormPosts').is(":checked"))
			{
				searchFormPosts = true;
			}
			if ($('#searchFormUsers').is(":checked"))
			{
				searchFormUsers = true;
			}
			if ($('#searchFormSkills').is(":checked"))
			{
				searchFormSkills = true;
			}
			console.log("about to enter phpFunctions:search");
			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', {'action' : 'search','skills': searchFormSkills , 'users' : searchFormUsers, 'posts' : searchFormPosts, 'entry' : searchFormEntry}, function(data){
				console.log("returned from phpFunctions:search");
				var verified = data['verified'];
				var postsVerified = data['posts'];
				var usersVerified = data['users'];
				var skillsVerified = data['skills'];
				var arrayLength = (data['resultArray']).length;
				
				if(verified===true){
					$('#divSearchResults').empty();

					$('#divSearchResults').append("<p>Results for search: "+data['entry']+"</p>");

					if(arrayLength===0){
						$('#divSearchResults').append("<p>No results found.</p>");
					}
					else if(postsVerified === 'true' && usersVerified === 'false'){
						for(var i = 0; i<arrayLength; i++){
							var title = data['resultArray'][i][2];
							$('#divSearchResults').append("<p><a href='http://46.101.34.183/mvc/mvc/public/home/viewPostDetails/"+data['resultArray'][i][1]+"'>Title: "+title+"</a></p>");
							$('#divSearchResults').append("<p>Description: "+data['resultArray'][i][3]+"</p>");
						}
					}
					//email,username,client_id
					else if(usersVerified==='true' && postsVerified==='false'){

						for(var i = 0; i<arrayLength; i++){
							var uname="";
							if(data['resultArray'][i][1]===null){
								uname=data['resultArray'][i][0];
							}
							else{
								uname=data['resultArray'][i][1];
							}
							$('#divSearchResults').append("<p><a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/"+data['resultArray'][i][2]+"'>User: "+uname+"</a></p>");
						}							
					}
					else if(usersVerified==='false' && postsVerified==='false' && skillsVerified==='true'){


						//arraydata['resultArray'][i][0] = client id of skill
						//arraydata['resultArray'][i][1] = skill id
						//arraydata['resultArray'][i][2] = skill
						//arraydata['resultArray'][i][3] = skill type
						//arraydata['resultArray'][i][4] = skill level

						for(var i = 0; i<arrayLength; i++){
							var skillname="";
							if(!(data['resultArray'][i][2]===null)){
								skillname=data['resultArray'][i][2];
							}
							else{
								skillname=data['resultArray'][i][1];
							}

							$('#divSearchResults').append("<p><a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/"+data['resultArray'][i][0]+"'>Skill: "+skillname+"</a></p><p>Skill type: "+data['resultArray'][i][3]+"</p><p>Skill level: "+data['resultArray'][i][4]+"</p>");
						}							
					}
					else{
						//do Nothing
					}					
					$('#divSearchResults').append("<p>End of results.</p>");
				}
				else if(verified===false){
				}
			});
		});

		$('#searchFormEntry').off('keyup').on('keyup', function(e){
			e.preventDefault();
			
			console.log('keyup');
			var searchFormEntry = $('#searchFormEntry').val();
			if(searchFormEntry ===""){
				searchFormCheck = false;
			}
			else{
				searchFormCheck = true;
			}
			checkSubmitValue(searchFormCheck,true,'#searchFormSubmit');

		});


		$('#passwordEditSubmit').off('click').on('click', function(e){
			e.preventDefault();

			console.log("password submitted");

			var password = $('#editPasswordInit').val();
			console.log("password: "+ password);
			
			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'password': password , 'action' : 'editPassword'}, function(data){

				var verified = data['verified'];
				if(verified===true){
					alert("Password changed.");
					$('#editPasswordInit').val("");
					$('#editPasswordRepeat').val("");
					$('#editCurrentPassword').val("");
					console.log("success");
				}
				else if(verified===false){
					console.log("failure");
				}
				console.log("Finished");


			});
		});

 		/*CHECKING NEWPASSWORDREPEAT KEYUP*/
		$('#editPasswordRepeat').off('keyup').on('keyup', function(e){
			e.preventDefault();

			$('#dynamicUserInfo').empty();

			if($('#editPasswordRepeat').val()===""){
				editNewPasswordCheck=false;
				$('#dynamicUserInfo').append("<p>Something's not quite right, make sure password is not empty.</p>");
			}
			else if($('#editPasswordInit').val() === $('#editPasswordRepeat').val()){
				editNewPasswordCheck=true;
			}
			else{
				$('#dynamicUserInfo').append("<p>Something's not quite right, check the passwords match.</p>");
				editNewPasswordCheck=false;
			}
			checkSubmitValue(editCurrentPasswordCheck,editNewPasswordCheck,'#passwordEditSubmit');
		});

		/*CHECKING NEWPASSWORDINIT KEYUP*/
		$('#editPasswordInit').off('keyup').on('keyup', function(e){
			e.preventDefault();
			
			$('#dynamicUserInfo').empty();

			if($('#editPasswordInit').val()===""){
				editNewPasswordCheck=false;
				$('#dynamicUserInfo').append("<p>Something's not quite right, make sure password is not empty.</p>");
			}
			else if($('#editPasswordInit').val() === $('#editPasswordRepeat').val()){
				editNewPasswordCheck=true;
			}
			else{
				$('#dynamicUserInfo').append("<p>Something's not quite right, check the passwords match.</p>");
				editNewPasswordCheck=false;
			}

			checkSubmitValue(editCurrentPasswordCheck,editNewPasswordCheck,'#passwordEditSubmit');
		});

		/*ON CURRENTPASSWORD KEYUP*/
		$('#editCurrentPassword').off('keyup').on('keyup', function(e){
			e.preventDefault();
		
			$('#dynamicUserInfo').append("<p id='passwordMessage'></p>");

			var currentPassword = $('#editCurrentPassword').val();
			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', {'password': currentPassword, 'action' : 'verifyPassword'}, function(data){
				
				var verified = data['verified'];
					
					if(verified===true){
						editCurrentPasswordCheck = true;
						$('#dynamicUserInfo').empty();
					}

					else if(verified===false){
						if(data['active']==0){
							$('#passwordMessage').html("Please verify email account first, check your entered password.");
						}
						else{
							$('#passwordMessage').html("Something's not quite right, check your entered password.");
						}
						editCurrentPasswordCheck=false;
					}
					checkSubmitValue(editCurrentPasswordCheck,editNewPasswordCheck,passwordEditSubmit);
			});
		});
		/*ON FAVOURPOST SUBMIT*/
		$('#makeFavourForm').on('change',function(e){
			e.preventDefault();

			var title = $('#favourFormTitle').val();
			var description = $('#favourFormDescription').val();
			var cost = $('#favourFormCost').val();

			if(title ==="" || description ==="" || cost === ""){	
				favourFormValueCheck = false;
			}
			else{
				favourFormValueCheck=true;
			}
			checkSubmitValue(favourFormValueCheck,favourDatepickerCheck, '#makeFavourSubmit');

		});

		$('#favourDatepicker').on('change',function(e){
			var dateContent = $('#favourDatepicker').val();

			if(dateContent === ""){	
				favourDatepickerCheck = false;
			}
			else{
				favourDatepickerCheck=true;
			}
			checkSubmitValue(favourFormValueCheck,favourDatepickerCheck, '#makeFavourSubmit');
			
		});

		$('#makeFavourSubmit').off('click').on('click', function(e){
			e.preventDefault();

			var title = $('#favourFormTitle').val();
			var description = $('#favourFormDescription').val();
			var expiry = $('#favourDatepicker').val();
			var cost = $('#favourFormCost').val();

			if(title ==="" || description ==="" || expiry === "" || cost === ""){	
			}
			else{
				$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'title' : title , 'description' : description ,'expiry' : expiry, 'cost' : cost, 'action' : 'favourSubmit'}, function(data){

					var verified = data['verified'];
					
					if(verified===true){
						
						$('#favourFormTitle').val("");
						$('#favourFormDescription').val("");
						$('#favourDatepicker').val("");
						$('#favourFormCost').val("");
						alert("Favour created.");
					}
					else if(verified===false){
						alert("Something went wrong, please check the values, and try again.");
					}
				});
					
			}
		});


		/*ON USERNAMEEDIT SUBMIT*/
		$('#usernameEditSubmit').off('click').on('click', function(e){
			e.preventDefault();
			var username = $('#editProfileUsername').val();
			if(username ===""){
			}
			else{
				$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'username' : username , 'action' : 'changeUsername'}, function(data){
					var verified = data['verified'];
					if(verified===true){
						$('#currentDetailsUsername').text("Username: "+username);
						alert("Username successfully updated.");
					}
					else if(verified===false){
					}
				});	
			}
		});

		/*ON EMAILEDIT SUBMIT*/
		$('#emailEditSubmit').off('click').on('click', function(e){
			e.preventDefault();
			var email = $('#editProfileEmail').val();
			if(email ===""){
			}
			else{
				$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', { 'email' : email , 'action' : 'changeEmail'}, function(data){
					
					var verified = data['verified'];
					if(verified===true){
						$('#editProfileEmail').val("");
						$('#currentDetailsEmail').text("Email: "+email);
						alert("Email successfully updated.");
					}
					else if(verified===false){
					}
				});	
			}
		});

		/*ON EMAIL EDIT*/
		$('#editProfileEmail').off('keyup').on('keyup',function(e){
			e.preventDefault();

			$('#dynamicUserInfo').empty();

			var email = $('#editProfileEmail').val();
			if(email ===""){
				//do nothing
			}
			else{
				$.post('http://46.101.34.183/mvc/mvc/includes/checkUsername.php', { 'email' : email }, function(data){
					
					var verified = data['verified'];
					if(verified===true){
						$('#dynamicUserInfo').append("<p>Username unavailable.</p>")
						emailCheck=false;
					}
					else if(verified===false){
						$('#dynamicUserInfo').append("<p>Username available.</p>")
						emailCheck=true;
					}
					checkSubmitValue(emailCheck,true,'#emailEditSubmit');
				});	
			}
		});


		/*ON FORM SUBMIT*/
		$('#createUserForm').off('submit').on('submit', function(e){
			e.preventDefault();

			var email = $('#createUserEmail').val() ;
			console.log("about to ajax");
			console.log("email"+email);
			$.post('http://46.101.34.183/mvc/mvc/includes/phpFunctions.php', {'action':'sendUserVerification','email' : email }, function(data){
				console.log("return from ajax");
				alert('Email sent, check your inbox.');
				window.location.replace("http://46.101.34.183/mvc/mvc/public/home");
			});
		});

		/*CHECKING EMAIL ON KEYUP*/
		$('#createUserEmail').off('keyup').on('keyup',function(e){
			e.preventDefault();

			$('#dynamicUserInfo').empty();
			var email = $('#createUserEmail').val();
			checkHiddenValue(true,true,'#dynamicInfoMasterDiv');
			if(email ===""){
				$('#dynamicUserInfo').append("<p>Email can't be empty.</p>");
			}
			else{
				$.post('http://46.101.34.183/mvc/mvc/includes/checkUsername.php', { 'email' : email}, function(data){
					
					var verified = data['verified'];
					if(verified===true){
						$('#dynamicUserInfo').append("<p>Email address is unavailable.</p>");
						emailCheck=false;
					}
					else if(verified===false){
						$('#dynamicUserInfo').append("<p>Email address is available.</p>");
						emailCheck=true;
					}
					checkSubmitValue(emailCheck,true,'#createUserSubmit');
				});	
			}

		});

		$('#logout').off('click').on('click',function(e){
			e.preventDefault();

			$.get('http://46.101.34.183/mvc/mvc/includes/logout.php');
			alert("About to logout");
			window.location.replace("http://46.101.34.183/mvc/mvc/public/home");

		});

		$('#loginForm').off('submit').on('submit',function(e){
			e.preventDefault();

			$('#dynamicUserInfo').empty();

			checkHiddenValue(true,true,'#dynamicInfoMasterDiv');

			checkHiddenValue(true,false,'#userMessageMasterDiv');

			var email = $('#email').val();
			console.log("hello");
			if(email===""|| $('#password').val()==="") {
				$('#dynamicUserInfo').append("<p>Please enter info in User and Password fields.</p>");
			}

			else{
				console.log("abouto enter checkUsername.php");
				$.post('http://46.101.34.183/mvc/mvc/includes/checkUsername.php', { 'email' : email}, function(data){
					console.log("returned from checkUsername.php");
					e.preventDefault();
					var emailVerified = data['verified'];
					console.log(emailVerified);
					if(emailVerified==true){
						//the email exists -> woohoo, verify the password
						if($('#password').val() === ""){
							console.log("password empty");
						}
						else{
							console.log("abouto enter verifyPassword.php");
							$.post('http://46.101.34.183/mvc/mvc/includes/verifyPassword.php',{'email': email, 'password': $('#password').val()}, function(data){
								console.log("returned from verifyPassword.php");
								e.preventDefault();
								var passwordVerified = data['verified'];
								if(passwordVerified===true){
									window.location.replace("http://46.101.34.183/mvc/mvc/public/home");
								}
								else if(passwordVerified===false){
									if(data['active']==0){
										$('#dynamicUserInfo').append("<p>Please verify email account first, check your email account.</p>");
									}
									else{
										$('#dynamicUserInfo').append("<p>Incorrect User/Password entered, please try again.</p>");
									}
								}
								else{
								}
							});
						}
					}
					else if(emailVerified===false){
						$('#dynamicUserInfo').append("<p>Incorrect User/Password entered, please try again.</p>");
					}
				});	
			}
		});

			
	
	});

});

	
