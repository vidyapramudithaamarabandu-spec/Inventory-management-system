const logoutButton=document.getElementById('logout-btn');

logoutButton.addEventListener('click',async()=>{
	try{
		localStorage.removeItem('userToken');
		sessionStorage.clear();
		
		alert('You have been Successfully Logged Out.');
		
		window.location.href='/login.php';
	}catch(error){
		console.error('Error during logout:',error);
		alter('Something went wrong.Please try again.');
	}
});
	