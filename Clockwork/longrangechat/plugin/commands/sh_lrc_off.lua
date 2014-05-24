--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).
--]]

local COMMAND = Clockwork.command:New("lrc_off");
COMMAND.tip = "Turn Long Range chat off and cancel the timer.";
COMMAND.access = "o";

-- Called when the command has been run.
function COMMAND:OnRun(player, arguments)
	Clockwork.kernel:SetSharedVar("lrc", 0);
	Clockwork.kernel:DestroyTimer("lrc_time");
	
	Clockwork.player:NotifyAll(player:Name().." has turned off long range chat.");
end;

COMMAND:Register();