<!DOCTYPE html>
<html >
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
           <style>
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                font-family: DejaVu Sans;
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                 position: fixed;
                 top: 0cm;
                 left: 0cm;
                 right: 0cm;
                 height: 1.5cm;

                 /** Extra personal styles **/
                 background-color: #03a9f4;
                 color: white;
                 text-align: center;
                 line-height: 0.5cm;
             }
              footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1.5cm;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 0.5cm;
            }
            img {
              max-width:70%;
              max-height:70%;
            }
        </style>

  </head>
  <body>
     <script type="text/php">
          if ( isset($pdf) ) {
            $x = 250;
            $y = 760;
            $text = "Trang {PAGE_NUM}/{PAGE_COUNT}";
            $font = null;
            $size = 11;
            $color = array(255,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
          }
       </script>
     <header>
       <p>{{$ticket->code}} - {{$ticket->user->name}} - {{$ticket->date_request}}</p>
     </header>
     <footer>
     </footer>
     <main>
       {!! $ticket->html !!}
     </main>
  </body>
</html>
