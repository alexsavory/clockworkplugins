--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).

	Clockwork was created by Conna Wiles (also known as kurozael.)
	https://creativecommons.org/licenses/by-nc-nd/3.0/legalcode
--]]

local Clockwork = Clockwork;
local pairs = pairs;
local string = string;


local PDCOMMANDS = [[
<h1> Info </h1>
This plugin allows you to add the said players CID to a dispatch message.<br>
The template is: <b> /poi 'John Doe' 'Person Interest'</b><br>
You still have to be a Elite Metropolice to use this.
<h1>Arguments:</h1><br>
'Person Interest'<br> 
'Citizenship'<br>
'Malcom'<br>
'Reminder' <br>
'Anti-Civil One'<br>
]]

Clockwork.directory:AddCategoryMatch("Personal Dispatch", "[icon]", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAADMSURBVDjLY/z//z8DJYCJgUKAYUBE+440IHYh1gAWLGIzgXgPFINBVFTU/1+/fjH8/v2bAUSD8N69exlBcozIYQCyHUgZAzGIdl1R6bGHVBeEAjW5Qr1QDnOFj4/Pf5jNMHzmzBlUFwA1hQIpkMZ7QKxErCtYoJqVoDaGATXcg/JBBnQAsYmdnR2GC27duoUZBuQAeBhERkZi2IKOYbEAop8/f05lF3h7e/8nZDsy/vz5M5VdYGtr+//nz59Y/QvDf/78QcbUcQHFuREAOJ3Rs6CmnfsAAAAASUVORK5CYII=");
Clockwork.directory:AddCategoryPage("Personal Dispatch", nil, PDCOMMANDS);
Clockwork.directory:SetCategoryTip("Personal Dispatch", "Explanation of the Personal dispatch plugin");
Clockwork.directory:AddCategory("Personal Dispatch", "Clockwork");