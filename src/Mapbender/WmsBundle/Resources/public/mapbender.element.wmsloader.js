(function($) {

    $.widget("mapbender.mbWmsloader", {
        options: {
            autoOpen: false,
            title: "Load WMS"
        },

        elementUrl: null,

        _create: function() {
            var self = this;
            this._super('_create');
            if(!Mapbender.checkTarget("mbWmsloader", this.options.target)){
                return;
            }

            Mapbender.elementRegistry.onElementReady(this.options.target, $.proxy(self._setup, self));
        },

        _setup: function(){

        },

        open: function() {
            var self = this;

            if(!$('body').data('mapbenderMbPopup')) {
                $("body").mbPopup();
                var content = this.element.show();

                $("body").mbPopup("addButton", "Cancel", "button buttonCancel critical right", function(){
                    self.element
                        .hide()
                        .detach()
                        .appendTo($('body'));
                    $("body").mbPopup("close");
                }).mbPopup("addButton", "Load", "button right", function(){
                    var url = $('#' + $(self.element).attr('id') + ' input[name="loadWmsUrl"]').val();
                    if(url === ''){
                        $('#' + $(self.element).attr('id') + ' input[name="loadWmsUrl"]').focus();
                        return false;
                    }
                    self.loadWms.call(self, url);
                    self.element
                        .hide()
                        .detach()
                        .appendTo($('body'));
                    $("body").mbPopup("close");
                })
                .mbPopup('showCustom', {
                    title:this.options.title,
                    content: content,
                    width: 380,
                    draggable: true
                });
            }
        },

        loadWms: function(getCapabilitiesUrl) {
            var self = this;
            if(getCapabilitiesUrl === null || getCapabilitiesUrl === '' ||
                (getCapabilitiesUrl.toLowerCase().indexOf("http://") !== 0 && getCapabilitiesUrl.toLowerCase().indexOf("https://") !== 0)){
                Mapbender.error("WMSLoader: a WMS capabilities can't be loaded! The capabilities url is not valid.");
                return;
            }
            var params = OpenLayers.Util.getParameters(getCapabilitiesUrl);
            var version = null, request = null, service = null;
            for(param in params){
                if(param.toUpperCase() === "VERSION"){
                    version = params[param];
                } else if(param.toUpperCase() === "REQUEST"){
                    request = params[param];
                } else if(param.toUpperCase() === "SERVICE"){
                    service = params[param];
                }
            }
            if(request === null || service === null){
                Mapbender.error("WMSLoader: a WMS capabilities can't be loaded! The capabilities url is not valid.");
                return;
            }

            if(service.toUpperCase() !== "WMS"){
                Mapbender.error('WMSLoader: the service "'+service+'" is not supported!');
                return false;
            } else if(request.toUpperCase() !== "GETCAPABILITIES" && request.toUpperCase() !== 'CAPABILITIES'){
                Mapbender.error('WMSLoader: the WMS Operation "'+request+'" is not supported!');
                return false;
            } else if(version && !(version.toUpperCase() === "1.1.0" || version.toUpperCase() === "1.1.1" || version.toUpperCase() === "1.3.0")){
                Mapbender.error('WMSLoader: the WMS version "'+version+'" is not supported!');
                return false;
            }
            // dataType is 'text' as otherwise jQuery tries to parse the response
            // and often fails with GetCapabilities documents.
            $.ajax({
                url: Mapbender.configuration.application.urls.proxy,
                data: {
                    url: getCapabilitiesUrl
                },
                dataType: 'text',
                success: function(data, textStatus, jqXHR) {
                    self._getCapabilitiesUrlSuccess(data, getCapabilitiesUrl);

                    // Maybe to much, need to be scoped!
                    $(".checkbox").trigger("change");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    self._getCapabilitiesUrlError(jqXHR, textStatus, errorThrown);
                }
            });
        },
        _getCapabilitiesUrlSuccess: function(xml, getCapabilitiesUrl) {
            var self = this;
            var mbMap = $('#' + self.options.target).data('mapbenderMbMap');
            var id = $('#' + this.options.target).data('mapbenderMbMap').genereateSourceId();
            var layerDefs = Mapbender.source.wms.layersFromCapabilities(xml, id, this.options.splitLayers, mbMap.model, this.options.defaultFormat, this.options.defaultInfoFormat);
            $.each(layerDefs, function(idx, layerDef){
                mbMap.addSource(layerDef, null, null);
            });
        },

        _getCapabilitiesUrlError: function(xml, textStatus, jqXHR) {
            Mapbender.error("WMSLoader: a wms capabilities can't be loaded!");
        },

        _destroy: $.noop
    });

})(jQuery);
