$( document ).ready( function () {
	$( "#signupForm" ).validate( {
		
		rules: {
			username: {
				required: true,
				minlength: 8,
				maxlength: 10,
				digits: true
			},
			fullname: {
				required: true,
				minlength: 3,
				maxlength: 100,
			},	
			email: {
				required: true,
				email: true,
				minlength: 10,
				maxlength: 100,
			},
			password: {
				required: true,
				minlength: 6,
				maxlength: 100,
			},	
			repassword: {
				required: true,
				minlength: 6,
				maxlength: 100,
				equalTo: "#password",
			},
			email: {
				required: true,
				minlength: 6,
				maxlength: 100,
				email: true,
			},	
			reemail: {
				required: true,
				minlength: 6,
				maxlength: 100,
				equalTo: "#email",
				email: true,
			}
		},
		messages: {
			username: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 8 ký tự",
				maxlength: "Vui lòng nhập tối đa 10 ký tự",
				digits: "Vui lòng nhập số nguyên dương"
			},
			fullname: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 3 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
			},
			email: {
				required: "Vui lòng nhập vào đây",
				email: "Vui lòng nhập đúng định dạng email",
				minlength: "Vui lòng nhập tối thiểu 10 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
			},
			password: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 6 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
			},
			repassword: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 6 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
				equalTo: "Vui lòng nhập trùng mật khẩu ở trên",
			},
			email: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 6 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
				email: "Vui lòng nhập đúng định dạng email"
			},
			reemail: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 6 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
				equalTo: "Vui lòng nhập trùng email ở trên",
				email: "Vui lòng nhập đúng định dạng email"
			}
		},
	});

	$( "#editAccount" ).validate( {
		
		rules: {
			fullname: {
				required: true,
				minlength: 3,
				maxlength: 100,
			},	
			email: {
				required: true,
				email: true,
				minlength: 10,
				maxlength: 100,
			},
			password: {
				minlength: 6,
				maxlength: 100,
			},	
			repassword: {
				minlength: 6,
				maxlength: 100,
				equalTo: "#password",
			},
			email: {
				required: true,
				minlength: 6,
				maxlength: 100,
				email: true,
			},	
			reemail: {
				required: true,
				minlength: 6,
				maxlength: 100,
				equalTo: "#email",
				email: true,
			}
		},
		messages: {
			fullname: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 3 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
			},
			email: {
				required: "Vui lòng nhập vào đây",
				email: "Vui lòng nhập đúng định dạng email",
				minlength: "Vui lòng nhập tối thiểu 10 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
			},
			password: {
				minlength: "Vui lòng nhập tối thiểu 6 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
			},
			repassword: {
				minlength: "Vui lòng nhập tối thiểu 6 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
				equalTo: "Vui lòng nhập trùng mật khẩu ở trên",
			},
			email: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 6 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
				email: "Vui lòng nhập đúng định dạng email"
			},
			reemail: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 6 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
				equalTo: "Vui lòng nhập trùng email ở trên",
				email: "Vui lòng nhập đúng định dạng email"
			}
		},
	});

	$( "#loginForm" ).validate( {
		
		rules: {
			username: {
				required: true,
				minlength: 8,
				maxlength: 10,
				digits: true
			},
			password: {
				required: true,
				minlength: 6,
				maxlength: 100,
			}
		},
		messages: {
			username: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 8 ký tự",
				maxlength: "Vui lòng nhập tối đa 10 ký tự",
				digits: "Vui lòng nhập số nguyên dương"
			},
			password: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 6 ký tự",
				maxlength: "Vui lòng nhập tối đa 100 ký tự",
			}
		},
	});
});