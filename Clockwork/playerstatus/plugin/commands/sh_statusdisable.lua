	--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).

	Clockwork was created by Conna Wiles (also known as kurozael.)
	https://creativecommons.org/licenses/by-nc-nd/3.0/legalcode
--]]

local COMMAND = Clockwork.command:New("statusdisable");
COMMAND.tip = "Disable your 'Status'";
COMMAND.flags = CMD_DEFAULT;

-- Called when the command has been run.
function COMMAND:OnRun(player, arguments)
		player:SetNWBool("statusenabled", false)
		Clockwork.player:Notify(player, "Disabled your status");
end;

COMMAND:Register();