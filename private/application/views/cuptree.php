<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="jquery.bracket.min.js"></script>
<link rel="stylesheet" type="text/css" href="cuptree_style.css" />
<script>


/* Custom data objects passed as teams */
var Data = {
    teams : [
     [{name: "Spain", logo: 'Spain'}, {name: "Portugal", logo: 'Portugal'}],
     [{name: "Netherlands", logo: 'Netherlands'}, {name: "Germany", logo: 'Germany'}],
     [{name: "Switzerland", logo: 'Switzerland'}, {name: "France", logo: 'France'}],
     [{name: "Italy", logo: 'Italy'}, {name: "Norway", logo: 'Norway'}]
      
    ],
    results : [
          /*First Round*/
          [
            [3,2], [3,4], [0,3], [2,0]
          ],
          /*Second Round*/
          [
            [2,1] , [2,1]
          ],
          /*Final Round*/
          [
            [2,1], [3,2]
          ]
        ]    
  }
 
/* Edit function is called when team label is clicked */
function edit_fn(container, data, doneCb) {
 
}
 
/* Render function is called for each team label when data is changed, data
 * contains the data object given in init and belonging to this slot. */
function render_fn(container, data, score) {
  if (!data.logo || !data.name)
    return
  container.append('<img src="https://www.betitbest.com/sportsnews/pool/teams/'+data.logo+'.png" /> ').append(data.name)
}

$(function() {
  $('body').bracket({
    init: Data,
    skipConsolationRound: true,
    decorator: {edit: edit_fn,
                render: render_fn}})
  })

</script>
</head>


<body>
<div>
</div>
</body>