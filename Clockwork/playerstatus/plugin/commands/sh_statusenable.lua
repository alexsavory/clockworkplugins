	--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).

	Clockwork was created by Conna Wiles (also known as kurozael.)
	https://creativecommons.org/licenses/by-nc-nd/3.0/legalcode
--]]

local COMMAND = Clockwork.command:New("statusenable");
COMMAND.tip = "Enable your 'Status'";
COMMAND.flags = CMD_DEFAULT;

-- Called when the command has been run.
function COMMAND:OnRun(player, arguments)
		player:SetNWBool("statusenabled", true)
		Clockwork.player:Notify(player, "Enabled your status");
end;

COMMAND:Register();