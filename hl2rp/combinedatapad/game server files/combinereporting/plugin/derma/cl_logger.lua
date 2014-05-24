
 -- The damn derma html has no documentation!
 -- We reverted to javascript to navigate shiz :/

function ViewLogger()

local reporturl = Clockwork.config:Get("logger_url"):Get()
local dateString = Clockwork.date:GetString();
local timeString = Clockwork.time:GetString();
local dayName = Clockwork.time:GetDayName();
local icdate = string.upper(dateString..". "..dayName..", "..timeString..".");
local steamid = Clockwork.Client:SteamID64()

local MOTDFrame = vgui.Create( "DFrame" )
MOTDFrame:SetTitle( "Event Logger" )
MOTDFrame:SetSize( ScrW() - 100, ScrH() - 100 )
MOTDFrame:Center()
MOTDFrame:SetBackgroundBlur( true )
MOTDFrame:SetDraggable( true )
MOTDFrame:SetSizable( true )
MOTDFrame:MakePopup()

local MOTDHTMLFrame = vgui.Create( "DHTML", MOTDFrame )
MOTDHTMLFrame:SetPos( 25, 50 )
MOTDHTMLFrame:SetSize( MOTDFrame:GetWide() - 50, MOTDFrame:GetTall() - 150 )
MOTDHTMLFrame:OpenURL(Clockwork.config:Get("logger_url"):Get())

-- Navigation
	BackButton = vgui.Create("DButton", MOTDFrame) 
	BackButton:SetText( "<- Go Back" ) 
	BackButton:SetSize( 100, 40 )
		BackButton:Center()
  BackButton:SetPos( (MOTDFrame:GetWide() - BackButton:GetWide()) / 2.67, MOTDFrame:GetTall() - BackButton:GetTall() - 10 )
	BackButton.DoClick = function()
	MOTDHTMLFrame:RunJavascript("history.back();")
	end 

	refreshbutton = vgui.Create("DButton", MOTDFrame) 
	refreshbutton:SetText( "Refresh" ) 
	refreshbutton:SetSize( 100, 40 )
	refreshbutton:Center()
  refreshbutton:SetPos( (MOTDFrame:GetWide() - refreshbutton:GetWide()) / 2, MOTDFrame:GetTall() - refreshbutton:GetTall() - 10 )
	refreshbutton.DoClick = function()
	MOTDHTMLFrame:RunJavascript("location.reload();")
	end 

		fowardbutton = vgui.Create("DButton", MOTDFrame) 
	fowardbutton:SetText( "Go Foward ->" ) 
	fowardbutton:SetSize( 100, 40 )
		fowardbutton:Center()
  fowardbutton:SetPos( (MOTDFrame:GetWide() - fowardbutton:GetWide()) / 1.6, MOTDFrame:GetTall() - fowardbutton:GetTall() - 10 )
	fowardbutton.DoClick = function()
	MOTDHTMLFrame:RunJavascript("history.forward();")
	end 

			fillbutton = vgui.Create("DButton", MOTDFrame) 
	fillbutton:SetText( "Insert IC Date/Time" ) 
	fillbutton:SetSize( 150, 20 )
		fillbutton:Center()
  fillbutton:SetPos( (MOTDFrame:GetWide() - fillbutton:GetWide()) / 6, MOTDFrame:GetTall() - fillbutton:GetTall() - 10 )
	fillbutton.DoClick = function()
	MOTDHTMLFrame:RunJavascript("document.getElementById('dateic').value = '"..icdate.."'") 
	end 
				steamidbutton = vgui.Create("DButton", MOTDFrame) 
	steamidbutton:SetText( "Quick Login" ) 
	steamidbutton:SetSize( 150, 20 )
		steamidbutton:Center()
  steamidbutton:SetPos( (MOTDFrame:GetWide() - steamidbutton:GetWide()) / 6, MOTDFrame:GetTall() - steamidbutton:GetTall() - 40 )
	steamidbutton.DoClick = function()
	MOTDHTMLFrame:RunJavascript("document.getElementById('steamid').value = '"..steamid.."'") 
	end 


end

