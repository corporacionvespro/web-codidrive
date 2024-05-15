function ws_basic_linear(j,g,a){
    var c=jQuery;
    var f=c(this);
    var e=a.find(".ws_list");
    var i=c("<div>").addClass("ws_effect ws_basic_linear").css({
            position:"relative",
            top:0,
            left:0,
            overflow:"hidden"
        }).appendTo(a);
    var b=c("<div>").css({
            position:"relative",
            display:"none",
            transform:"translate3d(0,0,0)"
        }).appendTo(i);
    var h=c("<div>").css({
            position:"relative",
            left:"auto",
            top:"auto",
            overflow:"hidden"
        }),
        d=h.clone();
    b.append(h,d);
    this.go=function(k,n,m){
        b.stop(1,1);
        if(m==undefined){
            m=(!!((k-n+1)%g.length)^j.revers?"left":"right")
        }else{
            m=m?"left":"right"
        }
        var o=c(g[n]);
        var l={
            width:o.width()||j.width,height:o.height()||j.height
        };
        o.clone().css(l).appendTo(h).css(m,0);c(g[k]).clone().css(l).appendTo(d).show();
        if(m=="right"){
            h.css("left","50%");
            d.css("left",0)
        }else{
            h.css("left",0);
            d.css("left","50%")
        }
        var q={},p={};q[m]=0;p[m]=-a.width();
        if(j.support.transform){
            if(m=="right"){
                q.left=q.right;
                p.left=-p.right
            }
            q={
                translate:[q.left,0,0]
            };
            p={
                translate:[p.left,0,0]
            }
        }
        e.hide();
        wowAnimate(b.css({
            left:"auto",right:"auto",top:0
        })
        .css(m,0).show(),q,p,j.duration,"easeInOutExpo",function(){
            f.trigger("effectEnd");
            b.hide().find("div").html("")
        })
    }
};
$('#myCarousel').carousel({
    interval: false
});

//scroll slides on swipe for touch enabled devices

$("#myCarousel").on("touchstart", function(event){

    var yClick = event.originalEvent.touches[0].pageY;
    $(this).one("touchmove", function(event){

        var yMove = event.originalEvent.touches[0].pageY;
        if( Math.floor(yClick - yMove) > 1 ){
            $(".carousel").carousel('next');
        }
        else if( Math.floor(yClick - yMove) < -1 ){
            $(".carousel").carousel('prev');
        }
    });
    $(".carousel").on("touchend", function(){
        $(this).off("touchmove");
    });
});

