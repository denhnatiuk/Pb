! function (e ) {
    var t = {};

    function n(o ) {
        if (t[o] ) return t[o].exports;
        var r = t[o] = {
            i: o,
            l: !1,
            exports: {}
        };
        return e[o].call(r.exports, r, r.exports, n ), r.l = !0, r.exports
    }
    n.m = e, n.c = t, n.d = function (e, t, o ) {
        n.o(e, t ) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: o
        } )
    }, n.r = function (e ) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        } ), Object.defineProperty(e, "__esModule", {
            value: !0
        } )
    }, n.t = function (e, t ) {
        if (1 & t &&(e = n(e ) ), 8 & t ) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule ) return e;
        var o = Object.create(null );
        if (n.r(o ), Object.defineProperty(o, "default", {
                enumerable: !0,
                value: e
            } ), 2 & t && "string" != typeof e )
            for(var r in e ) n.d(o, r, function (t ) {
                return e[t]
            }.bind(null, r ) );
        return o
    }, n.n = function (e ) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return n.d(t, "a", t ), t
    }, n.o = function (e, t ) {
        return Object.prototype.hasOwnProperty.call(e, t )
    }, n.p = "", n(n.s = 6 )
}([function (e ) {
    e.exports = JSON.parse('{"c":"section","b":"section block","a":{"namespace":"Pb"}}' )
}, function (e, t ) {
    e.exports = window.wp.element
}, function (e, t ) {
    e.exports = window.wp.blockEditor
}, function (e, t ) {
    e.exports = window.wp.i18n
}, function (e, t ) {
    e.exports = window.wp.primitives
}, function (e, t ) {
    e.exports = window.wp.blocks
}, function (e, t, n ) {
    "use strict";
    n.r(t );
    var o = {};
    n.r(o );
    var r = {};
    n.r(r );
    var c = n(1 ),
        i = n(0 ),
        s = n(5 ),
        l = n(2 ),
        a = n(3 ),
        u = n(4 );
    const p = {
        apiVersion: 2,
        name: i.a.namespace + "/" + i.c,
        title: i.a.namespace + " / " + i.c,
        category: "text",
        description: i.b,
        supports: {
            html: !1
        },
        textdomain: i.c,
        editorStyle: r,
        style: o,
        icon:() => Object(c.createElement )(u.SVG, {
            width: "18",
            height: "18",
            viewBox: "0 0 18 18",
            xmlns: "http://www.w3.org/2000/svg"
        }, Object(c.createElement )(u.Path, {
            d: "M4.5 9l5.6-5.7 1.4 1.5L7.3 9l4.2 4.2-1.4 1.5L4.5 9z"
        } ) ),
        edit:({} ) =>(Object(l.useBlockProps )({
            style: r
        } ), Object(c.createElement )("section", Object(l.useBlockProps )(), Object(a.__ )(i.c + " – hello from the editor!", i.c ) ) ),
        save:({} ) => {
            const e = l.useBlockProps.save({
                style: o
            } );
            return Object(c.createElement )("section", e.save(), Object(a.__ )(i.c + " – hello from the saved content!", i.c ) )
        }
    };
    Object(s.registerBlockType )("Pb/section", p )
}] );