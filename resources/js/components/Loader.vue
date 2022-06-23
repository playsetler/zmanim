<template>
<div id="circularG">
	<div id="circularG_1" class="circularG"></div>
	<div id="circularG_2" class="circularG"></div>
	<div id="circularG_3" class="circularG"></div>
	<div id="circularG_4" class="circularG"></div>
	<div id="circularG_5" class="circularG"></div>
	<div id="circularG_6" class="circularG"></div>
	<div id="circularG_7" class="circularG"></div>
	<div id="circularG_8" class="circularG"></div>
</div>
</template>

<script>
export default {
    name: "Loader",
    props: ["on"]
}
</script>

<style scoped>
#circularG{
	position:relative;
	width:128px;
	height:128px;
	margin: auto;
}

.circularG{
	position:absolute;
	background-color:rgb(0,164,128);
	width:30px;
	height:30px;
	border-radius:19px;
		-o-border-radius:19px;
		-ms-border-radius:19px;
		-webkit-border-radius:19px;
		-moz-border-radius:19px;
	animation-name:bounce_circularG;
		-o-animation-name:bounce_circularG;
		-ms-animation-name:bounce_circularG;
		-webkit-animation-name:bounce_circularG;
		-moz-animation-name:bounce_circularG;
	animation-duration:0.428s;
		-o-animation-duration:0.428s;
		-ms-animation-duration:0.428s;
		-webkit-animation-duration:0.428s;
		-moz-animation-duration:0.428s;
	animation-iteration-count:infinite;
		-o-animation-iteration-count:infinite;
		-ms-animation-iteration-count:infinite;
		-webkit-animation-iteration-count:infinite;
		-moz-animation-iteration-count:infinite;
	animation-direction:normal;
		-o-animation-direction:normal;
		-ms-animation-direction:normal;
		-webkit-animation-direction:normal;
		-moz-animation-direction:normal;
}

#circularG_1{
	left:0;
	top:51px;
	animation-delay:0.158s;
		-o-animation-delay:0.158s;
		-ms-animation-delay:0.158s;
		-webkit-animation-delay:0.158s;
		-moz-animation-delay:0.158s;
}

#circularG_2{
	left:13px;
	top:13px;
	animation-delay:0.214s;
		-o-animation-delay:0.214s;
		-ms-animation-delay:0.214s;
		-webkit-animation-delay:0.214s;
		-moz-animation-delay:0.214s;
}

#circularG_3{
	top:0;
	left:51px;
	animation-delay:0.27s;
		-o-animation-delay:0.27s;
		-ms-animation-delay:0.27s;
		-webkit-animation-delay:0.27s;
		-moz-animation-delay:0.27s;
}

#circularG_4{
	right:13px;
	top:13px;
	animation-delay:0.326s;
		-o-animation-delay:0.326s;
		-ms-animation-delay:0.326s;
		-webkit-animation-delay:0.326s;
		-moz-animation-delay:0.326s;
}

#circularG_5{
	right:0;
	top:51px;
	animation-delay:0.382s;
		-o-animation-delay:0.382s;
		-ms-animation-delay:0.382s;
		-webkit-animation-delay:0.382s;
		-moz-animation-delay:0.382s;
}

#circularG_6{
	right:13px;
	bottom:13px;
	animation-delay:0.428s;
		-o-animation-delay:0.428s;
		-ms-animation-delay:0.428s;
		-webkit-animation-delay:0.428s;
		-moz-animation-delay:0.428s;
}

#circularG_7{
	left:51px;
	bottom:0;
	animation-delay:0.484s;
		-o-animation-delay:0.484s;
		-ms-animation-delay:0.484s;
		-webkit-animation-delay:0.484s;
		-moz-animation-delay:0.484s;
}

#circularG_8{
	left:13px;
	bottom:13px;
	animation-delay:0.54s;
		-o-animation-delay:0.54s;
		-ms-animation-delay:0.54s;
		-webkit-animation-delay:0.54s;
		-moz-animation-delay:0.54s;
}



@keyframes bounce_circularG{
	0%{
		transform:scale(1);
	}

	100%{
		transform:scale(.3);
	}
}

@-o-keyframes bounce_circularG{
	0%{
		-o-transform:scale(1);
	}

	100%{
		-o-transform:scale(.3);
	}
}

@-ms-keyframes bounce_circularG{
	0%{
		-ms-transform:scale(1);
	}

	100%{
		-ms-transform:scale(.3);
	}
}

@-webkit-keyframes bounce_circularG{
	0%{
		-webkit-transform:scale(1);
	}

	100%{
		-webkit-transform:scale(.3);
	}
}

@-moz-keyframes bounce_circularG{
	0%{
		-moz-transform:scale(1);
	}

	100%{
		-moz-transform:scale(.3);
	}
}
</style>