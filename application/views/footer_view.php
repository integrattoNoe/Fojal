        		<div id="loader">
        			<svg width="70" height="20">
        			  <circle cx="10" cy="10" r="0">
        			    <animate attributeName="r" from="0" to="10" values="0;10;10;10;0" dur="1000ms" repeatCount="indefinite"/>
        			  </circle>
        			  <circle cx="35" cy="10" r="0">
        			    <animate attributeName="r" from="0" to="10" values="0;10;10;10;0" begin="200ms" dur="1000ms" repeatCount="indefinite"/>
        			  </circle>
        			  <circle cx="60" cy="10" r="0">
        			    <animate attributeName="r" from="0" to="10" values="0;10;10;10;0" begin="400ms" dur="1000ms" repeatCount="indefinite"/>
        			  </circle>
        			</svg>
        		</div>

        		<style>
        			/*$color: #76daff;*/
        			svg {
        			  position: fixed;
        			  top: 0; left: 0; right: 0; bottom: 0;
        			  margin: auto;
        			  
        			}
        			circle { fill: #2E4B8F; }

        			#loader{
        				display: none;
        				width: 100%;
        				height: 100%;
        				background: rgba(255,255,255,.6);
        				position: fixed;
        				flex-flow: row;
        				justify-content: center;
        				align-items: center;
        				top: 0;
        				z-index: 999;
        			}
        		</style>
        	</div><!--loadContent-->
        </div><!--row-->
    </div><!--main-->
</body>
</html>