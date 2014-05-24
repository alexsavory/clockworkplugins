--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).

	Clockwork was created by Conna Wiles (also known as kurozael.)
	https://creativecommons.org/licenses/by-nc-nd/3.0/legalcode
--]]

local Clockwork = Clockwork;

local COMMAND = Clockwork.command:New("redeem");
COMMAND.tip = "Redeem a donation code.";
COMMAND.text = "";
COMMAND.flags = bit.bor(CMD_DEFAULT, CMD_DEATHCODE);
COMMAND.arguments = 0;

-- Called when the command has been run.
function COMMAND:OnRun(player)
	 player:ConCommand("enterdonationkey")
end;

COMMAND:Register();