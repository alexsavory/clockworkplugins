--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).
--]]

local PANEL = {};

-- Called when the panel is initialized.
function PANEL:Init()
	self:SetBackgroundBlur(true);
	self:SetDeleteOnClose(false);
	
	-- Called when the button is clicked.
	function self.btnClose.DoClick(button)
		self:Close(); self:Remove();
		
		gui.EnableScreenClicker(false);
	end;
	
	self.panelList = vgui.Create("DPanelList", self);
 	self.panelList:SetPadding(2);
 	self.panelList:SetSpacing(3);
 	self.panelList:SizeToContents();
	self.panelList:EnableVerticalScrollbar();
end;

-- Called each frame.
function PANEL:Think()
	local scrW = ScrW();
	local scrH = ScrH();
	
	self:SetSize(300, 350);
	self:SetPos( (scrW / 2) - (self:GetWide() / 2), (scrH / 2) - (self:GetTall() / 2) );
end;

-- A function to populate the panel.
function PANEL:Populate(player, data)
	self:SetTitle( "'"..player:Name().."' - "..player:SteamName() );
	
	self.panelList:Clear();
	
	local textEntry = vgui.Create("DTextEntry");
	local button = vgui.Create("DButton");
	local playersteamid = vgui.Create("DTextEntry");
	local playersteamname = vgui.Create("DTextEntry");

	playersteamid:SetText(tostring(player:SteamID()))
	playersteamid:SetEditable(false)

	playersteamname:SetText(tostring(player:SteamName()))
	playersteamname:SetEditable(false)


	textEntry:SetMultiline(true);
	textEntry:SetHeight(256);
	textEntry:SetText(data);
	
	button:SetText("Okay");
	
	-- A function to set the text entry's real value.
	function textEntry:SetRealValue(text)
		self:SetValue(text);
		self:SetCaretPos( string.len(text) );
	end;
	
	-- Called each frame.
	function textEntry:Think()
		local text = self:GetValue();
		
		if (string.len(text) > 500) then
			self:SetRealValue( string.sub(text, 0, 500) );
			
			surface.PlaySound("common/talk.wav");
		end;
	end;
	
	-- Called when the button is clicked.
	function button.DoClick(button)
		self:Close(); self:Remove();
		
		if (IsValid(player)) then
			Clockwork.datastream:Start( "PlayerData", { player, string.sub(textEntry:GetValue(), 0, 500) } );
		end;
		
		gui.EnableScreenClicker(false);
	end;
	
	self.panelList:AddItem(playersteamid);
	self.panelList:AddItem(playersteamname);
	self.panelList:AddItem(textEntry);
	self.panelList:AddItem(button);
end;

-- Called when the layout should be performed.
function PANEL:PerformLayout()
	self.panelList:StretchToParent(4, 28, 4, 4);
	
	DFrame.PerformLayout(self);
end;

vgui.Register("cwplayerdata", PANEL, "DFrame");