function openBoxStats(mid, obj)
{
    $(obj).colorbox({
        iframe: true,
        href: baseurl + "livescores/"+language+"/statistic/7/"+mid,
        width: "960px",
        height: "640px",
        title: false,
        overlayClose: false,
        onClosed: function() {
            $.colorbox.remove();
        },
        // jQuery Inside Modal
        onComplete: function() {
        }
    });
}