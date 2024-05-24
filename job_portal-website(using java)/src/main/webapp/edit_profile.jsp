<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Profile Page</title>
<%@include file="all_component/all_css.jsp"%>
<style type="text/css">
.back-img{
background: url("img/j4.jpg");
width: 100%;
height: 85vh;
background-repeat: no-repeat;
background-size:cover;

}


</style>


</head>
<body>
	<%@include file="all_component/navbar.jsp"%>
	<div class="container-fluid back-img">
		<div class="row p-3">
			<div class="col-md-4 offset-md-4">
				<div class="card mr-4">
				<div class="card-header text-center text-white bg-custom">
				<i class="fa-solid fa-user"></i>
				<h4>Edit Profile</h4>
				</div>
				<div class="card-body">
				<c:if test="${empty userobj}">
   <c:redirect url="login.jsp"></c:redirect>
   </c:if> 
   
   <div class="card-body">
						<form action="update_profile" method="post">
						<input type="hidden" name="id" value="${userobj.id }">
							<div class="form-group">
								<label for=>Enter Full Name</label> <input
									type="text" required="required" class="form-control" id="exampleInputEmail1"
									aria-describedby="emailHelp" name="name" value="${userobj.name }">
								
							</div>
							<div class="form-group">
								<label>Enter Qualification</label> <input
									type="text" required="required" class="form-control" id="exampleInputPassword1"
									name="qua" value="${userobj.qualification }">
							</div>
							<div class="form-group">
								<label>Enter Email</label> <input
									type="email" required="required" class="form-control" id="exampleInputPassword1"
									name="email" value="${userobj.email }">
							</div>
							<div class="form-group">
						<label for="exampleInputPassword1">Enter Password</label> <input
							type="password" required="required" type="password" class="form-control" id="exampleInputPassword1"
							name="ps" value="${userobj.password }">
					</div>
							
							<button type="submit" class="btn btn-primary badage-pill btn-block">Update</button>
						</form>
					</div>
				</div>
</div>
			</div>
		</div>

	</div>
	<div style="margin-top:50px;">
	<%@include file="all_component/footer.jsp"%>
   
	
	</div>
	
   
   
   
   
				
				</body>
</html>