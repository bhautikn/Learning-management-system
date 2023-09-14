var r = document.querySelector(':root');
function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}
function themeChange() {
	if (getCookie("theme")=="light") {
			r.style.setProperty('--dark', '#222');
			r.style.setProperty('--light', 'white');
			r.style.setProperty('--gray', '#777');
			r.style.setProperty('--red', 'rgba(255, 0, 0, 0.5)');
			r.style.setProperty('--green', 'rgba(0, 255, 255, 0.6)');
			// r.style.setProperty('--shadow', 'black');
			document.cookie = "theme=dark";
		}
		else{
			r.style.setProperty('--dark', 'white');
			r.style.setProperty('--light', 'black');
			r.style.setProperty('--gray', 'black');
			r.style.setProperty('--red', 'darkred');
			r.style.setProperty('--green', 'seagreen');
			// r.style.setProperty('--shadow', 'black');
			document.cookie = "theme=light";
		}
}
if (getCookie("theme")=="light") {
	r.style.setProperty('--dark', 'white');
		r.style.setProperty('--light', 'black');
		r.style.setProperty('--gray', 'black');
		r.style.setProperty('--red', 'darkred');
		r.style.setProperty('--green', 'seagreen');
		// r.style.setProperty('--shadow', 'black');
}