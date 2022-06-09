<style type="text/css">
    /**
                     Set the margins of the page to 0, so the footer and the header
                    can be of the full height and width !
                **/
    @page {
        margin: 0cm 0cm;
    }

    @media print {

        pre,
        blockquote {
            page-break-inside: avoid;
        }
    }

    /** Define now the real margins of every page in the PDF **/
    body {
        margin-top: 3cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 2.8cm;
    }

    /** Define the header rules **/
    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
    }

    /** Define the footer rules **/
    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;

        /** Extra personal styles **/
        background-color: #1d4393;
        color: white;
        text-align: right;
        line-height: 20px;
    }

    main {
        font-size: 12.5px !important;
        text-align: justify;
        text-justify: inter-word;
        justify-content: space-around;
    }

    b {
        font-size: 12px !important;
    }

    .row {
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-wrap: wrap !important;
        flex-wrap: wrap !important;
        margin-right: -15px !important;
        margin-left: -15px !important;
    }

    .col,
    .col-1,
    .col-10,
    .col-11,
    .col-2,
    .col-3,
    .col-4,
    .col-5,
    .col-6,
    .col-7,
    .col-8,
    .col-9,
    .col-auto,
    .col-lg,
    .col-lg-1,
    .col-lg-10,
    .col-lg-11,
    .col-lg-12,
    .col-lg-2,
    .col-lg-3,
    .col-lg-4,
    .col-lg-5,
    .col-lg-6,
    .col-lg-7,
    .col-lg-8,
    .col-lg-9,
    .col-lg-auto,
    .col-md,
    .col-md-1,
    .col-md-10,
    .col-md-11,
    .col-md-12,
    .col-md-2,
    .col-md-3,
    .col-md-4,
    .col-md-5,
    .col-md-6,
    .col-md-7,
    .col-md-8,
    .col-md-9,
    .col-md-auto,
    .col-sm,
    .col-sm-1,
    .col-sm-10,
    .col-sm-11,
    .col-sm-12,
    .col-sm-2,
    .col-sm-3,
    .col-sm-4,
    .col-sm-5,
    .col-sm-6,
    .col-sm-7,
    .col-sm-8,
    .col-sm-9,
    .col-sm-auto,
    .col-xl,
    .col-xl-1,
    .col-xl-10,
    .col-xl-11,
    .col-xl-12,
    .col-xl-2,
    .col-xl-3,
    .col-xl-4,
    .col-xl-5,
    .col-xl-6,
    .col-xl-7,
    .col-xl-8,
    .col-xl-9,
    .col-xl-auto {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }

    .header {
        border-bottom: solid #1d4393;
        margin: 20px 80px 80px 80px;
        padding-bottom: 8px;
    }

    .url {
        color: #1d4393;
    }

    p {
        margin: 0;
        font-size: 14px;
        line-height: 18px;
    }

    .information_footer {
        padding-right: 80px;
        padding-top: 4px;
    }

    .page-number:before {
        content: counter(page);
        padding-top: 8px;
        padding-left: 80px;
    }
</style>
